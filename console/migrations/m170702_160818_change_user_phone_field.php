<?php

use yii\db\Migration;

class m170702_160818_change_user_phone_field extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%users}}', 'phone', $this->string());
    }

    public function down()
    {
        $this->alterColumn('{{%users}}', 'phone', $this->string()->notNull());
    }
}
