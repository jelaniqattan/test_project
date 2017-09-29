<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SumAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sum Addresses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sum-address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sum Address'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shop_address',
            'customer_address',
            'sum_km',
            'create_time',
            // 'update_time',
            // 'arrive',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
