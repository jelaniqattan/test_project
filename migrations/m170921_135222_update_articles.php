<?php

use yii\db\Migration;

class m170921_135222_update_articles extends Migration
{
    public function safeUp()
    {
        $this->addColumn('articles','image_name',$this->string()->after('article_name') );
    }

    public function safeDown()
    {
        echo "m170921_135222_update_articles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170921_135222_update_articles cannot be reverted.\n";

        return false;
    }
    */
}
