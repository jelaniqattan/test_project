<?php

use yii\db\Migration;

class m170925_141152_update_shopping_cart_item extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('fk_shopping_cart_items_user_id','shopping_cart_items','user_id','user', 'id');
        $this->addForeignKey('fk_shopping_cart_items_article_id','shopping_cart_items','article_id','articles', 'id');

    }

    public function safeDown()
    {
        echo "m170925_141152_update_shopping_cart_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170925_141152_update_shopping_cart_item cannot be reverted.\n";

        return false;
    }
    */
}
