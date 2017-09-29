<?php

namespace app\controllers;

use app\models\Country;
use app\models\DeliveryAddress;
use app\models\Employee;
use app\models\OrderArticle;
use app\models\ShoppingCartItem;
use Yii;
use app\models\Order;
use app\models\OrderSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionOrderCustomer()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Order();
        $deliveryAddress = new DeliveryAddress();
        if($model->load(Yii::$app->request->post()) && $deliveryAddress->load(Yii::$app->request->post())) {
            if($deliveryAddress->save()){
                $deliverers = Employee::find()->all();
                if(0 < count($deliverers)) {
                    shuffle($deliverers);
                    $deliverer = array_shift($deliverers);
                    $model->user_id = Yii::$app->user->id;          // save user in DB
                    $model->employee_id = $deliverer->id;
                    $model->delivery_address_id = $deliveryAddress->id;
                    $model->amount = 0;
                    $articlesToOrder = ShoppingCartItem::find()->where(['user_id'=>Yii::$app->user->id])->all();
                    foreach ($articlesToOrder as $v){
                        /* @var $v ShoppingCartItem */
                        $model->amount += $v->article->price*$v->number;
                    }
                    $model->arrive = (new \DateTime('now', new \DateTimeZone('Europe/Berlin')))->format('Y-m-d G:i:s');
                    if($model->save())
                    {
                     foreach ($articlesToOrder as $v)
                     {
                         $addToOrder_Articles = new OrderArticle();
                         $addToOrder_Articles->order_id = $model->id;
                         $addToOrder_Articles->article_id = $v->article_id;
                         $addToOrder_Articles->category_id = $v->article->category_id;
                         $addToOrder_Articles->article_name = $v->article->article_name;
                         $addToOrder_Articles->price = $v->article->price*$v->number;
                         $addToOrder_Articles->save();
                     }
                    }
                    /*
                    $articlesToOrder = ShoppingCartItem::find()->where(['user_id' => $model->user_id])->all();*/
                    /* @var $articlesToOrder OrderArticle */
                    /*foreach ($articlesToOrder as $v)
                    {
                        $v->order_id=
                    }
                    */
                }
            }

        }

        $countryList = ArrayHelper::map(Country::find()->all(), 'id', 'name');

        return $this->render('order_customer', [
            'model' => $model,
            'deliveryAddress' => $deliveryAddress,
            'countryList'=> $countryList,
        ]);

    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
