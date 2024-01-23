<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_gallery}}`.
 */
class m240115_114042_create_post_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_gallery}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'image'=>$this->string('255'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post_gallery}}');
    }
}
