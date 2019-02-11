<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%material}}`.
 */
class m190211_094758_create_material_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%material}}', [
            'id' => $this->primaryKey(),
            'file_name' => $this->string(20)->notNull(),

            'title' => $this->string(50)->notNull(),
            'description' => $this->string(),

            'type' => $this->string()->notNull(),
            'mime_type' => $this->string(7)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%material}}');
    }
}
