<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "delivery_addresses".
 *
 * @property integer $id
 * @property string $city
 * @property string $country
 * @property integer $zipcode
 * @property string $street
 * @property string $note
 * @property string $create_time
 * @property string $update_time
 * @property string $arrive_time
 *
 * @property Order[] $orders
 */
class DeliveryAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_addresses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'country', 'zipcode', 'street'], 'required'],
            [['country','zipcode'], 'integer'],
            [['create_time', 'update_time', 'arrive_time'], 'safe'],
            [['city', 'street'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
            'zipcode' => Yii::t('app', 'Zipcode'),
            'note' => Yii::t('app', 'Note'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'arrive_time' => Yii::t('app', 'Arrive Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['delivery_address_id' => 'id']);
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
