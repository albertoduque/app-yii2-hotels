<?php

namespace app\controllers;

use yii\rest\Controller;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Hotels;

class HotelsController extends Controller {
  public function behaviors() {
    $behaviors = parent::behaviors();
    // remove authentication filter
    $auth = $behaviors['authenticator'];
    unset($behaviors['authenticator']);
    // add CORS filter
    $behaviors['corsFilter'] = [
        'class' => \yii\filters\Cors::className(),
    ];

    return $behaviors;
  }

  public function actions() {
    $actions = parent::actions();
    $actions['options'] = [
      'class' => 'app\components\Cors',
    ];
    return $actions;
  }

  public function actionIndex() {
    return new ActiveDataProvider([
        'query' => Hotels::find(),
    ]);
  }

  public function actionView($id){
    return Hotels::findOne($id);
  }

}
