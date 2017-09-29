<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $employee_id
 * @property integer $delivery_address_id
 * @property integer $sum_address_id
 * @property string $amount
 * @property string $note
 * @property string $create_time
 * @property string $update_time
 * @property string $arrive
 *
 * @property DeliveryAddress $deliveryAddress
 * @property Employee $employee
 * @property SumAddress $sumAddress
 */
class Order extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'employee_id', 'delivery_address_id', 'amount', 'note'], 'required'],
            [['user_id', 'employee_id', 'delivery_address_id', 'sum_address_id'], 'integer'],
            [['amount'], 'number'],
            [['create_time', 'update_time', 'arrive'], 'safe'],
            [['note'], 'string', 'max' => 255],
            [['delivery_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeliveryAddress::className(), 'targetAttribute' => ['delivery_address_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['sum_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => SumAddress::className(), 'targetAttribute' => ['sum_address_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'delivery_address_id' => Yii::t('app', 'Delivery Address ID'),
            'sum_address_id' => Yii::t('app', 'Sum Address ID'),
            'amount' => Yii::t('app', 'Amount'),
            'note' => Yii::t('app', 'Note'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'arrive' => Yii::t('app', 'Arrive'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryAddress()
    {
        return $this->hasOne(DeliveryAddress::className(), ['id' => 'delivery_address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSumAddress()
    {
        return $this->hasOne(SumAddress::className(), ['id' => 'sum_address_id']);
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
