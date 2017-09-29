<?php

use yii\db\Migration;

class m170921_060721_create_category extends Migration
{
    public function safeUp()
    {
        $this->createTable('categories', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'update_time' => $this->dateTime(),
            'create_time' => $this->dateTime(),
        ), 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->addForeignKey('fk_articles_category_id', 'articles', 'category_id', 'categories', 'id');
    }

    public function safeDown()
    {
        echo "m170921_060721_create_category cannot be reverted.\n";

        return false;
    }




    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170921_060721_create_category cannot be reverted.\n";

        return false;
    }
    */
}
