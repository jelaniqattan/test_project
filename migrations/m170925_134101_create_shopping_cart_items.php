<?php

use yii\db\Migration;

class m170925_134101_create_shopping_cart_items extends Migration
{
    public function safeUp()
    {
        $this->createTable('shopping_cart_items',array(
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'article_id' => $this->integer()->notNull(),
            'number' => $this->integer()->notNull(),
            'create_time' => $this->dateTime(),
            'update_time' => $this->dateTime(),
            )
            , 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    public function safeDown()
    {
        echo "m170925_134101_create_shopping_cart_items cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170925_134101_create_shopping_cart_items cannot be reverted.\n";

        return false;
    }
    */
}
