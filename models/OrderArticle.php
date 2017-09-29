<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "order_articles".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $article_name
 * @property string $price
 * @property string $create_time
 * @property string $update_time
 */
class OrderArticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'article_name', 'price'], 'required'],
            [['category_id'], 'integer'],
            [['price'], 'number'],
            [['create_time', 'update_time'], 'safe'],
            [['article_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'article_name' => Yii::t('app', 'Article Name'),
            'price' => Yii::t('app', 'Price'),
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
