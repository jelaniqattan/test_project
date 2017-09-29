<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'Category',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a($data->name,Yii::$app->urlManager->createUrl(['/article/index/','ArticleSearch[category_id]' => $data->id]));
                }
            ],
        ],
    ]);
            var_dump(['category_id']);die();
; ?>
</div>
