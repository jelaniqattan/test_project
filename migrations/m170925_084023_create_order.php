<?php

use yii\db\Migration;

class m170925_084023_create_order extends Migration
{
    public function safeUp()
    {
        $this->createTable('orders', array(
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->notNull(),
                'employee_id' => $this->integer()->notNull(),
                'delivery_address_id' => $this->integer()->notNull(),
                'sum_address_id' => $this->integer()->notNull(),
                'amount' => $this->decimal(9,2)->notNull(),
                'note' => $this->string(255)->notNull(),
                'create_time' => $this->dateTime(),
                'update_time' => $this->dateTime(),
                'arrive' => $this->dateTime(),
            )
            , 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createTable('employees',array(
            'id' => $this->primaryKey(),
            'first_name' => $this->string(50)->notNull(),
            'last_name' => $this->string(50)->notNull(),
            'create_time' => $this->dateTime(),
            'update_time' => $this->dateTime(),
        ), 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createTable('delivery_addresses',array(
            'id' => $this->primaryKey(),
            'city' => $this->string(50)->notNull(),
            'country' => $this->string(50)->notNull(),
            'zipcode' => $this->integer()->notnull(),
            'note' => $this->string(255),
            'create_time' => $this->dateTime(),
            'update_time' => $this->dateTime(),
            'arrive_time' => $this->dateTime(),
        ), 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createTable('order_articles',array(
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notnull(),
            'article_name' => $this->string(50)->notNull(),
            'price' => $this->decimal(9,2)->notnull(),
            'create_time' => $this->dateTime(),
            'update_time' => $this->dateTime(),

        ), 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->createTable('sum_addresses',array(
            'id' => $this->primaryKey(),
            'shop_address' => $this->string(255),
            'customer_address' => $this->string(255),
            'sum_km' => $this->decimal(9,2)->notnull(),
            'create_time' => $this->dateTime(),
            'update_time' => $this->dateTime(),
            'arrive' => $this->dateTime(),
        ), 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');


        $this->addForeignKey('fk_orders_employee_id','orders','employee_id','employees', 'id');
        $this->addForeignKey('fk_orders_delivery_address_id','orders','delivery_address_id','delivery_addresses', 'id');
        $this->addForeignKey('fk_orders_sum_address_id','orders','sum_address_id','sum_addresses', 'id');

    }

    public function safeDown()
    {
        echo "m170925_084023_create_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170925_084023_create_order cannot be reverted.\n";

        return false;
    }
    */
}
