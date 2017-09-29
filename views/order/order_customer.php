<?php
/* @var $countryList array */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\Order */
/* @var $countryList array */
/* @var $deliveryAddress app\models\DeliveryAddress */
?>

<div class="site-order-customer">
    <h1>Order</h1>


    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]);

    ?>
    <? // element type (ich habe geschrieben) ?>
    <?= $form->field($deliveryAddress, 'city')->textInput() ?>
    <?= $form->field($deliveryAddress, 'country')->dropDownList($countryList) ?>
    <?= $form->field($deliveryAddress, 'zipcode')->textInput() ?>
    <?= $form->field($deliveryAddress, 'street')->textInput() ?>
    <?= $form->field($model, 'note')->textarea() ?>



    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('order', ['class' => 'btn btn-primary', 'name' => 'login-button', Yii::$app->urlManager->createUrl('/site/index')]) ?>
            <a href="<?= Yii::$app->urlManager->createUrl('/site/index')?>" class="btn btn-success"><?=Yii::t('app', 'go home')?></a>

        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>