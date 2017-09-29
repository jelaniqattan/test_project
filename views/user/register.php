<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\UserModel */
/* @var $countryList array */
?>

<div class="site-login">
    <h1>Registration</h1>


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
    <?= $form->field($model, 'amount')->textInput() ?>
    <?= $form->field($model, 'first_name')->textInput() ?>
    <?= $form->field($model, 'last_name')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>
    <?= $form->field($model, 'city')->textInput() ?>
    <?= $form->field($model, 'country_id')->dropDownList($countryList) ?>
    <?= $form->field($model, 'street')->textInput() ?>
    <?= $form->field($model, 'zipcode')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('register', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>