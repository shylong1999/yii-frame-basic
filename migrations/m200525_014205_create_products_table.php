<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m200525_014205_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'p_name' => $this->string()->notNull(),
            'p_price' => $this->integer()->notNull(),
            'p_amount' => $this->integer(),
            'discount' => $this->integer(),
            'c_id' => $this->integer(10),
            'images' => $this->string(),
//            'created_at' => $this->timestamp(),
//            'deleted_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
