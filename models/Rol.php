<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property int $idRol
 * @property string|null $nombre
 *
 * @property User[] $users
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRol' => 'Id Rol',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['rol_id' => 'idRol']);
    }

    /**
     * 
     */
    public function assignRol($auth, $id) {
      $model = Rol::findOne($id);
      $rol = $auth->getRole($model->nombre);
      
      if($rol==NULL) {
        $rol = $auth->createRole($model->nombre);
        $auth->add($rol);
      }

      return $rol;
    }
}
