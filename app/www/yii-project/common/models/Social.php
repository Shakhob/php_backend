<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "social".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $image
 * @property string|null $link
 * @property int|null $sort
 * @property int|null $status
 */
class Social extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'status'], 'default', 'value' => null],
            [['sort', 'status'], 'integer'],
            [['name', 'image', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'link' => 'Link',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
}
