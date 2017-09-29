<?php

namespace app\controllers;

use app\models\Category;
use app\models\ShoppingCartItem;
use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCadd($id)  // add icon
    {
        /* @var $v ShoppingCartItem */
        /* @var $t Article */
        $v = ShoppingCartItem::find()->where(['user_id' => Yii::$app->user->id, 'article_id' => $id])->one();
        if (!isset($v)) {
            $t = Article::find()->where(['id' => $id])->one();
            if (isset($t)) {
                $toAdd = new ShoppingCartItem();
                $toAdd->user_id = Yii::$app->user->id;
                $toAdd->article_id = $t->id;
                $toAdd->number = 1;
                if ($toAdd->save(false)) {
                    Yii::$app->session->addFlash('success', 'Added to Cart: ' . $toAdd->number . 'x "' . $toAdd->article->article_name . '"');
                }
            }
        } else {
            $v->number++;
            if ($v->save(false)) {
                Yii::$app->session->addFlash('success', 'Added to Cart: ' . $v->number . 'x "' . $v->article->article_name . '"');
            }
        }

        return $this->redirect(Yii::$app->urlManager->createUrl('/article/customer'));

    }

    public function actionCsub($id)
    {
        /* @var $v ShoppingCartItem */
        /* @var $t Article */
        $v = ShoppingCartItem::find()->where(['user_id' => Yii::$app->user->id, 'article_id' => $id])->one();
        if (isset($v)) {
            if (1 < $v->number) {
                $v->number--;
                if ($v->save(false)) {
                    Yii::$app->session->addFlash('error', 'Sub from Cart:' . $v->number . 'x "' . $v->article->article_name . '"');
                }
            }else {
            $v->delete();
            Yii::$app->session->addFlash('error', 'Delete Cart: ' . $v->number . 'x "' . $v->article->article_name . '"');
            }
        }


        return $this->redirect(Yii::$app->urlManager->createUrl('/article/customer'));
    }


    public function actionBuy($id)
    {
        $v = ShoppingCartItem::find()->where(['user_id' => Yii::$app->user->id, 'article_id' => $id])->one();
        if (!isset($v)) {
            $t = Article::find()->where(['id' => $id])->one();
            if (isset($t)) {
                $toAdd = new ShoppingCartItem();
                $toAdd->user_id = Yii::$app->user->id;
                $toAdd->article_id = $t->id;
                $toAdd->number = 1;
                if ($toAdd->save(false)) {
                    Yii::$app->session->addFlash('success', 'Added to Cart And Buy Cart Now: ' . $toAdd->number . 'x "' . $toAdd->article->article_name . '"');
                }
            }
        } else {
            $v->number++;
            if ($v->save(false)) {
                Yii::$app->session->addFlash('success', 'Added to Cart And Buy Now: ' . $v->number . 'x "' . $v->article->article_name . '"');
            }
        }

        return $this->redirect(Yii::$app->urlManager->createUrl('/shopping-cart-item/customer'));
    }


    public function actionCustomer()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('customer', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCartlist($id)
    {
        //$searchModel = new ArticleSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->where(['category_id' => $id]),
        ]);
        return $this->render('cartlist', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        $categoryList = ArrayHelper::map(Category::find()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->image_file = UploadedFile::getInstance($model, 'image_file');
            $name = md5(microtime() . $model->image_file->baseName);
            if ($model->image_file->saveAs(Yii::$app->basePath . '/uploads/' . $name . '.' . $model->image_file->extension)) {
                $model->image_name = $name . '.' . $model->image_file->extension;
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                    'model' => $model,
                    'categoryList' => $categoryList,
                ]
            );
        }

    }


    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categoryList = ArrayHelper::map(Category::find()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categoryList' => $categoryList,
            ]);
        }
    }


    /**
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
