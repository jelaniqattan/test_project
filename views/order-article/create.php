<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderArticle */

$this->title = Yii::t('app', 'Create Order Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
