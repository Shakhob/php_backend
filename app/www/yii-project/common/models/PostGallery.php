<?php

namespace common\models;

use common\components\StaticFunctions;
use Yii;

/**
 * This is the model class for table "post_gallery".
 *
 * @property int $id
 * @property int|null $post_id
 * @property string|null $image
 */
class PostGallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id'], 'default', 'value' => null],
            [['post_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'image' => 'Image',
        ];
    }

}
