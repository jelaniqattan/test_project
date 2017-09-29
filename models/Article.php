<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\UploadedFile;


/**
 * This is the model class for table "articles".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $article_name
 * @property string $image_name
 * @property string $price
 * @property string $description
 * @property string $update_time
 * @property string $create_time
 * @property UploadedFile $image_file
 *
 * @property Category $category
 */
class Article extends ActiveRecord
{
    public $image_file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
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
            [['description'], 'string'],
            [['update_time', 'create_time'], 'safe'],
            [['article_name'], 'string', 'max' => 50],
            [['image_name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            ['image_file', 'image', 'extensions' => 'png, jpg',
                'minWidth' => 100, 'maxWidth' => 1000,
                'minHeight' => 100, 'maxHeight' => 1000,
            ],
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
            'image_name' => Yii::t('app', 'Image Name'),
            'price' => Yii::t('app', 'Price'),
            'description' => Yii::t('app', 'Description'),
            'update_time' => Yii::t('app', 'Update Time'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    /**
     * @return \app\models\Category
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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
