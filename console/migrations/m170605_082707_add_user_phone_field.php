<?php

use yii\db\Migration;

class m170605_082707_add_user_phone_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%users}}', 'phone', $this->string()->notNull());

        $this->createIndex('{{%idx-users-phone}}', '{{%users}}', 'phone', true);
    }

    public function down()
    {
        $this->dropColumn('{{%users}}', 'phone');
    }
}
