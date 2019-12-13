<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url; 
use  yii\bootstrap\Modal;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    charset ?>">
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
       
       // 'brandLabel' => Html::img('@web/img/logo.png',['width'=>'100%','alt'=>Yii::$app->name,'class'=>'cotizador-logo']),
      //  'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    
     if (!\Yii::$app->user->isGuest) {
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            ['label' => 'Home', 'url' => ['/site/login']],
            ['label' => 'Inscripciones', 'url' => ['/inscripcion/index-menu']], 
            ['label' => 'Facturación', 'url' => ['/factura/index-menu']],
            ['label' => 'Reportes', 
                'items' => [
                     ['label' => 'Listado Inscripciones', 'url' => ['/factura/generar-excel']],
                ],
            ],
            [ // el 2 es el rol de administrador
                'label' => 'Configuración',
                'items' => [
                    ['label' => 'Eventos', 'url' => ['/evento']],
                    '<li class="divider"></li>',
                    ['label' => 'Producto', 'url' => ['/producto/index']], 
                    '<li class="divider"></li>',
                ]
            ],
            
           Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-user"></span> Login', 'url' => ['/site/login']] :
            ['label' => '<span class="glyphicon glyphicon-off"></span> Logout [' . Html::encode(Yii::$app->user->identity->username) . ']',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']],
        ],
    ]);
     }
    NavBar::end();
     
    ?>
 <div class="logo-container">
    <div class="brand">
        Naturgas
    </div>
</div>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
    <?php Modal::begin([
            'header'=>'<h4 id="modalHeader">Datos</h4>',
            'id'=>'modal-inicial',
            'size'=>'modal-lg'
       ]);
       echo "<div id='modalContent'></div>";
       Modal::end();?>
    <?php Modal::begin([
            'header'=>'<h4 id="modalHeader">Datos</h4>',
            'id'=>'modal-alterno',
            'size'=>'modal-lg'
       ]);
       echo "<div id='modalContent'></div>";
       Modal::end();?>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Naturgas S.A.S. <?= date('Y') ?></p>

   
    </div>
</footer>

<?php $this->endBody() ?>
    <div class="modalcompleto"></div>
</body>
</html>
<?php $this->endPage() ?>
