<?php

namespace common\models;

use common\components\StaticFunctions;
use creocoder\translateable\TranslateableBehavior;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string|null $preview_text
 * @property string|null $body
 * @property int|null $order
 * @property int|null $status
 */
class Post extends \yii\db\ActiveRecord
{
    public $galleryImages = [];
    public $name_ru;
    public $name_en;

    public function behaviors()
    {
        return [
            'translateable' => [
                'class' => TranslateableBehavior::className(),
                'translationAttributes' => ['name','url'],
                // translationRelation => 'translations',
                // translationLanguageAttribute => 'language',
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['body'], 'string'],
            [['order', 'status'], 'default', 'value' => null],
            [['order', 'status'], 'integer'],
            [['title', 'preview_text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'preview_text' => 'Preview Text',
            'body' => 'Body',
            'order' => 'Order',
            'status' => 'Status',
        ];
    }
    public function getGallery()
    {
        $result=[];
        $galleryImages = PostGallery::find()->where(['post_id' => $this->id])->all();
        if (!empty($galleryImages)){
            foreach ($galleryImages as $galleryImage){
                $result[] = [
                    'image'=>StaticFunctions::getImage($galleryImage->image, 'post', $this->id),
                    'url' => 'post/delete-image',
                    'key' => $galleryImage->id,
                ];
            }
        }
        return $result;
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_INSERT | self::OP_UPDATE,
        ];
    }

    public function getTranslations()
    {
        return $this->hasMany(PostTranslation::className(), ['post_id' => 'id']);
    }

}
