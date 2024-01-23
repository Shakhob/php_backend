<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu_translation".
 *
 * @property int $id
 * @property int|null $menu_id
 * @property string|null $language
 * @property string|null $name
 * @property string|null $url
 */
class MenuTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_translation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['menu_id'], 'default', 'value' => null],
            [['menu_id'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_id' => 'Menu ID',
            'language' => 'Language',
            'name' => 'Name',
            'url' => 'Url',
        ];
    }
}
