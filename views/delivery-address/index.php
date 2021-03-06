<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeliveryAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Delivery Addresses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Delivery Address'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'city',
            'country',
            'zipcode',
            'note',
            // 'create_time',
            // 'update_time',
            // 'arrive_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
