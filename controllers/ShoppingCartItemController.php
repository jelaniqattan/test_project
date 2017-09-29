<?php

namespace app\controllers;

use app\models\Article;
use app\models\OrderArticle;
use Yii;
use app\models\ShoppingCartItem;
use app\models\ShoppingCartItemSearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShoppingCartItemController implements the CRUD actions for ShoppingCartItem model.
 */
class ShoppingCartItemController extends Controller
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
     * Lists all ShoppingCartItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShoppingCartItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCadd($id,$url)  // add icon
    {
        Yii::$app->user->id;            //user find
        $v= ShoppingCartItem::find()->where(['user_id' => Yii::$app->user->id,'article_id' => $id ])->one();
        // wir suchen von der user hat log in gemachet der Artikle haben
        /* @var  $v ShoppingCartItem */
        if(isset($v)) {  // wenn gibt mach plus ein mit + zeichnen
            $v->number++;
            $v->save();
            Yii::$app->session->addFlash('success','Added to Cart: '. $v->number. 'x "'. $v->article->article_name.'"');
            // zeichen open was hast du gemacht
        }
        //return $this->redirect(Yii::$app->urlManager->createUrl('/shopping-cart-item/customer'));
        return $this->redirect($url);
        // mach redirect zum web site nach auf + zeichnen druken und plus one more
    }

    public function actionCsub($id)
    {
        Yii::$app->user->id;
        $v= ShoppingCartItem::find()->where(['user_id' => Yii::$app->user->id,'article_id' => $id])->one();
        /* @var  $v ShoppingCartItem */
        if(isset($v)) {
            if(1<$v->number){
                $v->number--;
                $v->save();
                Yii::$app->session->addFlash('error','Sub from Cart: '. $v->number. 'x "'. $v->article->article_name.'"');

            }
            else
            {
                $v->delete();
                Yii::$app->session->addFlash('error','Delete Cart: '. $v->number. 'x "'. $v->article->article_name.'"');
            }
/*            if($v->number == 0){
                return $this->redirect(Yii::$app->urlManager->createUrl('/shopping-cart-item/customer'));
            }*/
        }
        return $this->redirect(Yii::$app->urlManager->createUrl('/shopping-cart-item/customer'));
    }

    public function actionRemove($id)
    {
        $v= ShoppingCartItem::find()->where(['user_id' => Yii::$app->user->id,'article_id' => $id ])->one();
        if (isset($v)){
            $v->delete();
            Yii::$app->session->addFlash('error','Delete Cart ');

        }
        return $this->redirect(Yii::$app->urlManager->createUrl('/shopping-cart-item/customer'));
    }



    public function actionCustomer()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $orderedArticle = ShoppingCartItem::find()->where(['user_id' => Yii::$app->user->id])->all();
        // $listArticle = array(); //nicht mehr notwendig
        $totalAmount = 0;
        if (0 < count($orderedArticle)) {
            foreach ($orderedArticle as $v) {
                /* @var Article $art */
                /* @var ShoppingCartItem $v */
                /**
                 * nicht mehr notwendig
                $listArticle[] = array(
                    'id' => $v->article_id,
                    'name' => $v->article->article_name,
                    'price' => $v->article->price*$v->number,
                    'total' => array_sum(['price']),
                    'number' => $v->number,
                );*/
                $totalAmount+=$v->article->price*$v->number;
            }
        }
        /**
        $dataProvider = new ArrayDataProvider([
            'allModels' => $listArticle,
            'sort' => [
                'attributes' => ['name', 'price', 'number'],
            ],
            'pagination' => [
                'pageSize' => 10        // count items bis 10 und dann nue site laden
            ],
        ]);
        */
        $dataProvider = new ActiveDataProvider([            // ActiveDataProvider site
            'query' => ShoppingCartItem::find()->where(['user_id' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);


        return $this->render('customer', [
            'dataProvider' => $dataProvider,
            'totalAmount' => $totalAmount,
        ]);
    }

    /**
     * Displays a single ShoppingCartItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ShoppingCartItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShoppingCartItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ShoppingCartItem model.
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
     * Deletes an existing ShoppingCartItem model.
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
     * Finds the ShoppingCartItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShoppingCartItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShoppingCartItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
