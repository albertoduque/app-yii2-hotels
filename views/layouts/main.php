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
use  yii\web\Session;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
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
    
    $session = Yii::$app->session;
    if (!\Yii::$app->user->isGuest && !$session->isActive && Yii::$app->request->url!="/") {
        $session->destroy();
        return Yii::$app->response->redirect(Url::to(['site/login']));
    }
    //$auth = Yii::$app->authManager;
     if (!\Yii::$app->user->isGuest && $session->isActive) {
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            $session->get('event_id') ?
            ['label' => 'Home', 'url' => ['/site/login']] : '',
            Yii::$app->user->can('inscripciones') && $session->get('event_id') ?
            ['label' => 'Inscripciones', 'url' => ['/inscripcion/index-menu']] : '', 
            Yii::$app->user->can('facturacion')  && $session->get('event_id') ?
            ['label' => 'Facturación', 'url' => ['/factura/index-menu']] : '',
            Yii::$app->user->can('reportes')  && $session->get('event_id') ?
            ['label' => 'Reportes', 
                'items' => [
                     ['label' => 'Reporte General', 'url' => ['/factura/generar-excel']],
                ],
            ] : '',
            Yii::$app->user->can('configuracion') && $session->get('event_id')?
            [ // el 2 es el rol de administrador
                'label' => 'Configuración',
                'items' => [
                     '<li class="dropdown-submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tablas del Sistema</a>
                            <ul class="dropdown-menu">',
                                    ['label' => 'Ciudad', 'url' => ['/ciudad']],
                                    '<li class="divider"></li>',
                                    ['label' => 'Eventos', 'url' => ['/evento']],
                                    '<li class="divider"></li>',
                                     ['label' => 'País', 'url' => ['/pais']],
                                    '<li class="divider"></li>',
                                    ['label' => 'Parametros', 'url' => ['/parametro']],
                                    '<li class="divider"></li>',
                                    ['label' => 'Producto', 'url' => ['/producto/index']], 
                                    '<li class="divider"></li>',
                                    ['label' => 'Información Empresa', 'url' => ['/informacion-empresa/index']],
                                    '<li class="divider"></li>',
                                    ['label' => 'Usuarios', 'url' => ['/user']],
                                     '<li class="divider"></li>',
                                    ['label' => 'Roles', 'url' => ['/rol']],
                            '</ul>
                     </li>',
                    '<li class="dropdown-submenu">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tablas del Evento</a>
                            <ul class="dropdown-menu">',
                                    ['label' => 'Cargos', 'url' => ['/cargo']],
                                    '<li class="divider"></li>',
                                    ['label' => 'Empresas', 'url' => ['/empresa']],
                                    '<li class="divider"></li>',
                                    ['label' => 'Forma Pago', 'url' => ['/forma-pago']],
                                    '<li class="divider"></li>',
                                     ['label' => 'Tipo Asistente', 'url' => ['/tipo-asistente']],
                                   
                            '</ul>
                     </li>',
                    
                    
                ]
            ] : '',
            ['label' => '<span class="glyphicon glyphicon-off"></span> Logout [' . Html::encode(Yii::$app->user->identity->username) . ']',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']],
            $session->isActive && $session->get('event_id') ? 
            ['label'=> $session->get('event_name')] : '',
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
        <div style="float:right;margin-top: 10px;margin-right: 10px;">
         <?php if($session->isActive && $session->get('event_id')) echo $session->get('event_name') ?>
        </div>
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
