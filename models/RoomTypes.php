<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_types".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property RoomHotels[] $roomHotels
 */
class RoomTypes extends \app\models\User
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 350],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomHotels()
    {
        return $this->hasMany(RoomHotels::className(), ['room_type_id' => 'id']);
    }
}
