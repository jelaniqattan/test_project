<?php

use yii\db\Migration;

class m170928_085527_update_delivery_address_country extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('fk_delivery_address_country_id','delivery_addresses','country','countries', 'id');

    }

    public function safeDown()
    {
        echo "m170928_085527_update_delivery_address_country cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170928_085527_update_delivery_address_country cannot be reverted.\n";

        return false;
    }
    */
}
