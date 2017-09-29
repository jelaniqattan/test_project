<?php

use yii\db\Migration;

class m170928_122650_update_order_articles_order_id extends Migration
{
    public function safeUp()
    {
        $this->addColumn('order_articles','order_id',$this->integer()->notNull()->after('id'));
        $this->addColumn('order_articles','article_id',$this->integer()->notNull()->after('order_id'));
        $this->addForeignKey('fk_order_article_order_id','order_articles','order_id','orders', 'id');
        $this->addForeignKey('fk_order_article_article_id','order_articles','article_id','articles', 'id');
        $this->addForeignKey('fk_order_article_category_id','order_articles','category_id','categories', 'id');


    }

    public function safeDown()
    {
        echo "m170928_122650_update_order_articles_order_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170928_122650_update_order_articles_order_id cannot be reverted.\n";

        return false;
    }
    */
}
