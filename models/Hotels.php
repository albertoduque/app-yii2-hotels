<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotels".
 *
 * @property string|null $name
 * @property string|null $nit
 * @property int|null $city_id
 * @property int $id
 * @property string|null $address
 * @property int|null $rooms
 *
 * @property RoomHotels[] $roomHotels
 */
class Hotels extends \app\models\User
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'rooms'], 'default', 'value' => null],
            [['city_id', 'rooms'], 'integer'],
            [['name'], 'string', 'max' => 300],
            [['nit'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'nit' => 'Nit',
            'city_id' => 'City ID',
            'id' => 'ID',
            'address' => 'Address',
            'rooms' => 'Rooms',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomHotels()
    {
        return $this->hasMany(RoomHotels::className(), ['hotels_id' => 'id']);
    }
}
