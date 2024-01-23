<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu}}`.
 */
class m240110_064752_create_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->null(),
            'name' => $this->string('255'),
            'url' => $this->string('255'),
            'menu_order' => $this->integer()->null(),
            'status'=>$this->tinyInteger()->defaultValue(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%menu}}');
    }
}
