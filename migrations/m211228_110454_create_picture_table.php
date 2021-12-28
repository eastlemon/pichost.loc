<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%picture}}`.
 */
class m211228_110454_create_picture_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%picture}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Name'),
            'target' => $this->string()->comment('Target'),
            'ext' => $this->string()->comment('Extension'),
            'created_at' => $this->string()->comment('Creation Time'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%picture}}');
    }
}
