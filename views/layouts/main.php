<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Jelani Store',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Category', 'url' => ['/category/index']],
            ['label' => 'Cat', 'url' => ['/category/category']],
            ['label' => 'Articles', 'url' => ['/article/index']],
            ['label' => 'ArtCus', 'url' => ['/article/customer']],
            ['label' => 'Order', 'url' => ['/order/order-customer']],
//           ['label' => 'Employee', 'url' => ['/employee/index']],
//            ['label' => 'Delivery Address', 'url' => ['/delivery-address/index']],
            ['label' => 'Order Article', 'url' => ['/order-article/index']],
            ['label' => 'Sum Address', 'url' => ['/sum-address/index']],
//            ['label' => 'Category', 'url' => ['/category/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Shopping', 'url' => ['/shopping-cart-item/index']],
            ['label' => 'ShopCus', 'url' => ['/shopping-cart-item/customer']],
            ['label' => 'Register', 'url' => ['/user/register'], 'visible' => Yii::$app->user->isGuest],
            Yii::$app->user->isGuest ? ( // verbenden mit meine seite
            ['label' => 'Login', 'url' => ['/site/login']]


            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->user_name . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    echo '<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>';
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php if(Yii::$app->session->hasFlash('success')):?>
            <?php foreach(Yii::$app->session->getFlash('success') AS $test):?>
                <p class="alert alert-success" role="alert"><?= $test?></p>
            <?php endforeach;?>
        <?php endif;?>
        <?php if(Yii::$app->session->hasFlash('error')):?>
            <?php foreach(Yii::$app->session->getFlash('error') AS $test):?>
                <p class="alert alert-danger" role="alert"><?= $test?></p>
            <?php endforeach;?>
        <?php endif;?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">Aicovo Gmbh <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
