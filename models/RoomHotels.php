<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_hotels".
 *
 * @property int $id
 * @property int|null $hotels_id
 * @property int|null $room_type_id
 * @property int|null $room_location_id
 * @property int|null $quantity
 *
 * @property Hotels $hotels
 * @property RoomLocations $roomLocation
 * @property RoomTypes $roomType
 */
class RoomHotels extends \app\models\User
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room_hotels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'hotels_id', 'room_type_id', 'room_location_id', 'quantity'], 'default', 'value' => null],
            [['id', 'hotels_id', 'room_type_id', 'room_location_id', 'quantity'], 'integer'],
            [['id'], 'unique'],
            [['hotels_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hotels::className(), 'targetAttribute' => ['hotels_id' => 'id']],
            [['room_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => RoomLocations::className(), 'targetAttribute' => ['room_location_id' => 'id']],
            [['room_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RoomTypes::className(), 'targetAttribute' => ['room_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotels_id' => 'Hotels ID',
            'room_type_id' => 'Room Type ID',
            'room_location_id' => 'Room Location ID',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotels()
    {
        return $this->hasOne(Hotels::className(), ['id' => 'hotels_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomLocation()
    {
        return $this->hasOne(RoomLocations::className(), ['id' => 'room_location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomType()
    {
        return $this->hasOne(RoomTypes::className(), ['id' => 'room_type_id']);
    }
}
