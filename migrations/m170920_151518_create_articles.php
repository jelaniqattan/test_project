<?php

use yii\db\Migration;

class m170920_151518_create_articles extends Migration
{
    public function safeUp()
    {
        $this->createTable('articles', array(
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notnull(),
            'article_name' => $this->string(50)->notNull(),
            'price' => $this->decimal(9,2)->notNull(),
            'description' => $this->text(),
            'update_time' => $this->dateTime(),
            'create_time' => $this->dateTime(),
        )            , 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    public function safeDown()
    {
        echo "m170920_151518_create_articles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170920_151518_create_articles cannot be reverted.\n";

        return false;
    }
    */
}
