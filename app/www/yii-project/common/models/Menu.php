<?php

namespace common\models;

use creocoder\translateable\TranslateableBehavior;
use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $name
 * @property string|null $url
 * @property int|null $menu_order
 * @property int|null $status
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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

    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'menu_order', 'status'], 'default', 'value' => null],
            [['parent_id', 'menu_order', 'status'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => 'ID',
//            'parent_id' => 'Parent ID',
//            'name' => 'Name',
//            'url' => 'Url',
//            'menu_order' => 'Menu Order',
//            'status' => 'Status',
//        ];
//    }

    public function attributeLabels()
    {
        switch (Yii::$app->language) {
            case 'ru':
                return [
                    'name' => 'Заголовок',
                    'position' => 'Позиция',
                ];
            case 'en':
                return [
                    'name' => 'name',
                    'position' => 'position',
                ];
            default:
                return [
                    'name' => 'nomi',
                    'position' => 'joylashuvi',
                ];
        }
    }

    public function getParent()
    {
        return $this->hasOne(self::class, ['id' => 'parent_id']);
    }

    public function getChildren()
    {
        return $this->hasMany(self::class, ['parent_id' => 'id']);
    }


    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_INSERT | self::OP_UPDATE,
        ];
    }

    public function getTranslations()
    {
        return $this->hasMany(MenuTranslation::className(), ['menu_id' => 'id']);
    }
}
