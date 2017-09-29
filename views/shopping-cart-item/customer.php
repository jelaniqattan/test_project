<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $totalAmount float */

$this->title = Yii::t('app', 'Shopping Cart Items');
$this->params['breadcrumbs'][] = $this->title;

$actionCol = ['class' => 'yii\grid\ActionColumn',
    'template' => '{addto} {subfrom} {remove}',
    'buttons' => [
        'addto' => function ($url, $model) {
            return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                'title' => Yii::t('app', 'Add one'),
            ]);
        },
        'subfrom' => function ($url, $model) {
            return Html::a('<span class="glyphicon glyphicon-minus"></span>', $url, [
                'title' => Yii::t('app', 'Subtract one'),
            ]);
        },
        'remove' => function ($url, $model) {
            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                'title' => Yii::t('app', 'Remove'),
            ]);
        }
    ],
    'urlCreator' => function ($action, $model, $key, $index) {
        if ($action === 'addto') {
            $url = Yii::$app->urlManager->createUrl(['/shopping-cart-item/cadd', 'id' => $model['article_id']]);
            return $url;
        }
        if ($action === 'subfrom') {
            $url = Yii::$app->urlManager->createUrl(['/shopping-cart-item/csub', 'id' => $model['article_id']]);
            return $url;
        }
        if ($action === 'remove') {
            $url = Yii::$app->urlManager->createUrl(['/shopping-cart-item/remove', 'id' => $model['article_id']]);
            return $url;
        }
    }
];

?>
<div class="shopping-cart-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'article.article_name',
            'article.price:currency',
            'article.category.name',
            'number',
            [
                'header'=>Yii::t('app','Sum'),
                'value' => function($data){
                    return $data->number*$data->article->price;
                },
                'format'=>'currency',
            ],
            $actionCol,
        ],
        'emptyText' => Yii::t('app', 'Your shopping cart is empty'),
    ]) ?>
<span><?= Yii::t('app', 'Gesamtwarenwert ihres Einkaufs: <strong>{0,number,currency}</strong>',$totalAmount)?></span>


    <p>
        <?php // Html::a(Yii::t('app', 'jetzt kostenpflichtig bestellen'), [Yii::$app->urlManager->createUrl('/order/order-customer')], ['class' => 'btn btn-success']) ?>
        <a href="<?= Yii::$app->urlManager->createUrl('/order/order-customer')?>" class="btn btn-success"><?=Yii::t('app', 'Buy Now')?></a>
    </p>



</div>
