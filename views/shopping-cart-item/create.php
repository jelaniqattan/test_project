<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ShoppingCartItem */

$this->title = Yii::t('app', 'Create Shopping Cart Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shopping Cart Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shopping-cart-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
