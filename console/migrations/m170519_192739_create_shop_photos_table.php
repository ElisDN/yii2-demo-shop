<?php

use yii\db\Migration;

class m170519_192739_create_shop_photos_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_photos}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'file' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_photos-product_id}}', '{{%shop_photos}}', 'product_id');

        $this->addForeignKey('{{%fk-shop_photos-product_id}}', '{{%shop_photos}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%shop_photos}}');
    }
}
