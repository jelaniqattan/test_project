<?php

use yii\db\Migration;

class m170920_095207_create_country_id extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('user','country');
        $this->addColumn('user', 'country_id',$this->integer()->notNull()->after('street'));
        $this->addForeignKey('fk_user_country_id','user','country_id','countries', 'id');
    }

    public function safeDown()
    {
        echo "m170920_095207_create_country_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170920_095207_create_country_id cannot be reverted.\n";

        return false;
    }
    */
}
