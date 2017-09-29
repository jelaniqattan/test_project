<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ShoppingCartItem */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Shopping Cart Item',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shopping Cart Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shopping-cart-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
