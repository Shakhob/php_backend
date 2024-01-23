<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_translation}}`.
 */
class m240115_050054_create_post_translation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_translation}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'language' => $this->string('16'),
            'title' => $this->string('255'),
            'preview_text' => $this->string('255'),
            'body' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post_translation}}');
    }
}
