<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SumAddress */

$this->title = Yii::t('app', 'Create Sum Address');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sum Addresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sum-address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
