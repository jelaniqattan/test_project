<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "sum_addresses".
 *
 * @property integer $id
 * @property string $shop_address
 * @property string $customer_address
 * @property string $sum_km
 * @property string $create_time
 * @property string $update_time
 * @property string $arrive
 *
 * @property Orders[] $orders
 */
class SumAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sum_addresses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum_km'], 'required'],
            [['sum_km'], 'number'],
            [['create_time', 'update_time', 'arrive'], 'safe'],
            [['shop_address', 'customer_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_address' => Yii::t('app', 'Shop Address'),
            'customer_address' => Yii::t('app', 'Customer Address'),
            'sum_km' => Yii::t('app', 'Sum Km'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'arrive' => Yii::t('app', 'Arrive'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['sum_address_id' => 'id']);
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
