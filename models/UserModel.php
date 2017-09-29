<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $last_name
 * @property string $first_name
 * @property string $email
 * @property string $password
 * @property string $birthday
 * @property integer $zipcode
 * @property string $city
 * @property string $street
 * @property integer $country_id
 * @property string $update_time
 * @property string $create_time
 *
 * @property Country $country
 */
class UserModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */

public $passwordRepeat;


    public function rules()
    {
        return [
            [['user_name', 'last_name', 'first_name', 'email', 'password','passwordRepeat', 'zipcode', 'city', 'street', 'country_id'], 'required'],
            [['birthday', 'update_time', 'create_time'], 'safe'],
            [['zipcode', 'country_id'], 'integer'],
            [['email'],'email'],
            [['email'],'filter','filter'=>'trim'],
            [['email'],'filter','filter'=>'strtolower'],
            [['user_name', 'last_name', 'first_name', 'city', 'street'], 'string', 'max' => 50],
            [['email', 'password'], 'string', 'max' => 255],
            [['email', 'password'], 'string', 'min' => 8],
            //['password','compare','compareAttribute' => 'email','operator' => '!='],
            ['password','compareWithLower','params'=>'email'],
            [ 'password', 'compare','compareAttribute' => 'passwordRepeat'],
            [['email'],'unique'],

            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }
public function compareWithLower($attribute,$params)
{
    if(strtolower($this->{$attribute}) == strtolower($this->{$params})){
        $this->addError($attribute,$this->getAttributeLabel($attribute). ' can not be '. $this->getAttributeLabel($params));
    }

}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_name' => Yii::t('app', 'User Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'first_name' => Yii::t('app', 'First Name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'birthday' => Yii::t('app', 'Birthday'),
            'zipcode' => Yii::t('app', 'Zipcode'),
            'city' => Yii::t('app', 'City'),
            'street' => Yii::t('app', 'Street'),
            'country_id' => Yii::t('app', 'Country ID'),
            'update_time' => Yii::t('app', 'Update Time'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

        // es ist für spiecher zeit selber aber wir müssen löschen von view von geleich order
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

