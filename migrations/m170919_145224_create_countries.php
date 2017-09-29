<?php

use yii\db\Migration;

class m170919_145224_create_countries extends Migration
{
    public function safeUp()
    {
        $this->createTable('countries', array(
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
        )
            , 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    public function safeDown()
    {
        echo "m170919_145224_create_countries cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170919_145224_create_countries cannot be reverted.\n";

        return false;
    }
    */
}
