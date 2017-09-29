<?php

use yii\db\Migration;

class m170928_073426_update_order extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('fk_order_user_id','orders','user_id','user', 'id');

    }

    public function safeDown()
    {
        echo "m170928_073426_update_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170928_073426_update_order cannot be reverted.\n";

        return false;
    }
    */
}
