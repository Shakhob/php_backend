<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu_translation}}`.
 */
class m240110_064937_create_menu_translation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menu_translation}}', [
            'id' => $this->primaryKey(),
            'menu_id' => $this->integer(),
            'language' => $this->string('16'),
            'name' => $this->string('255'),
            'url' => $this->string('255'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%menu_translation}}');
    }
}
