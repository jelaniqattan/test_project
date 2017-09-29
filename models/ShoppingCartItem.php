<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "shopping_cart_items".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $article_id
 * @property integer $number
 * @property string $create_time
 * @property string $update_time
 *
 * @property Article $article
 */
class ShoppingCartItem extends ActiveRecord
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shopping_cart_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id', 'number'], 'required'],
            [['user_id', 'article_id', 'number'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
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
            'article_id' => Yii::t('app', 'Article ID'),
            'number' => Yii::t('app', 'Number'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
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

