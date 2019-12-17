<?php

namespace app\controllers;

use Yii;
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

  public function actionCreate() {
    $model = new Hotels();
    
    $model->name = Yii::$app->request->getBodyParam('name');
    $model->city_id = Yii::$app->request->getBodyParam('city_id');
    $model->nit = Yii::$app->request->getBodyParam('nit');
    $model->address = Yii::$app->request->getBodyParam('address');
    $model->rooms = Yii::$app->request->getBodyParam('rooms');

    if($model->validate()) {
      $model->save();
      return ['response' => 'Ok'];
    }
    return ['response' => 'faild'];
    
  }

}
