<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_translation".
 *
 * @property int $id
 * @property int|null $post_id
 * @property string|null $language
 * @property string|null $title
 * @property string|null $preview_text
 * @property string|null $body
 */
class PostTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_translation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id'], 'default', 'value' => null],
            [['post_id'], 'integer'],
            [['body'], 'string'],
            [['language'], 'string', 'max' => 16],
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
            'post_id' => 'Post ID',
            'language' => 'Language',
            'title' => 'Title',
            'preview_text' => 'Preview Text',
            'body' => 'Body',
        ];
    }
}
