<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_locations".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property RoomHotels[] $roomHotels
 */
class RoomLocations extends \app\models\User
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room_locations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 350],
            [['id'], 'unique'],
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
        return $this->hasMany(RoomHotels::className(), ['room_location_id' => 'id']);
    }
}
