<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $listArticle array */

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-catartview">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $actionCol = ['class' => 'yii\grid\ActionColumn',
        'template' => '{addto} {subfrom} {buy}',
        'buttons' => [
            'addto' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                    'title' => Yii::t('app', 'Add one'),
                ]);
            },
            'subfrom' => function ($url, $model, $id) {
                $v = \app\models\ShoppingCartItem::find()->where(['user_id' => Yii::$app->user->id, 'article_id' => $id])->exists();
                if ($v) {
                    return Html::a('<span class="glyphicon glyphicon-minus"></span>', $url, [
                        'title' => Yii::t('app', 'Subtract one'),
                    ]);
                }
            },
            'buy' => function ($url, $model) {

                return Html::a('<span class="glyphicon glyphicon-shopping-cart"></span>', $url, [
                    'title' => Yii::t('app', 'Buy'),
                ]);
            }
        ],
        'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'addto') {
                $url = Yii::$app->urlManager->createUrl(['/shopping-cart-items/cadd', 'id' => $model['id'], 'url' => Yii::$app->request->url]);
                return $url;
            }
            if ($action === 'subfrom') {
                $url = Yii::$app->urlManager->createUrl(['/article/csub', 'id' => $model['id']]);
                return $url;
            }
            if ($action === 'buy') {
                $url = Yii::$app->urlManager->createUrl(['/article/buy', 'id' => $model['id']]);
                return $url;
            }
        }
    ];

    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'article_name',
            'price',
            $actionCol
            // 'description:ntext',
            // 'update_time',
            // 'create_time',


        ],
    ]); ?>
</div>
