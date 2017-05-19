<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_characteristics`.
 */
class m170519_085957_create_shop_characteristics_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_characteristics}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type' => $this->string(16)->notNull(),
            'required' => $this->boolean()->notNull(),
            'default' => $this->string(),
            'variants_json' => 'JSON NOT NULL',
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%shop_characteristics}}');
    }
}
