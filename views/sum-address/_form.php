<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SumAddress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sum-address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'shop_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sum_km')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'arrive')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
