<?php

use yii\db\Migration;

class m170919_090811_create_user extends Migration
{
    public function safeUp()
    {           // new table contact with DATABASE
        $this->createTable('user', array(
                'id' => $this->primaryKey(),
                'user_name' => $this->string(50)->notNull(),
                'last_name' => $this->string(50)->notNull(),
                'first_name' => $this->string(50)->notNull(),
                'email' => $this->string(255)->notNull(),
                'password' => $this->string(255)->notNull(),
                'birthday' => $this->date(),
                'zipcode' => $this->integer(5)->notNull(),
                'city' => $this->string(50)->notNull(),
                'country' => $this->string(50)->notNull(),
                'street' => $this->string(50)->notNull(),
                'update_time' => $this->dateTime(),
                'create_time' => $this->dateTime(),
            )  // make für data form wir konnen später tauschen
            , 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');



    }

    public function safeDown()
    {
        echo "m170919_090811_create_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170919_090811_create_user cannot be reverted.\n";

        return false;
    }
    */
}
