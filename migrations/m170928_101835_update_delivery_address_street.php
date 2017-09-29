<?php

use yii\db\Migration;

class m170928_101835_update_delivery_address_street extends Migration
{
    public function safeUp()
    {
        $this->addColumn('delivery_addresses','street',$this->string()->notNull()->after('zipcode'));
    }

    public function safeDown()
    {
        echo "m170928_101835_update_delivery_address_street cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170928_101835_update_delivery_address_street cannot be reverted.\n";

        return false;
    }
    */
}
