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
            'name' => $this->string()->notNull()->comment('Name'),
            'uniq_name' => $this->string()->notNull()->comment('Unique Name'),
            'target' => $this->string()->notNull()->comment('Target'),
            'ext' => $this->string()->notNull()->comment('Extension'),
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
