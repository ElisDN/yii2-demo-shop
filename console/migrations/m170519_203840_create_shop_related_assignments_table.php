<?php

use yii\db\Migration;

class m170519_203840_create_shop_related_assignments_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_related_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'related_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-shop_related_assignments}}', '{{%shop_related_assignments}}', ['product_id', 'related_id']);

        $this->createIndex('{{%idx-shop_related_assignments-product_id}}', '{{%shop_related_assignments}}', 'product_id');
        $this->createIndex('{{%idx-shop_related_assignments-related_id}}', '{{%shop_related_assignments}}', 'related_id');

        $this->addForeignKey('{{%fk-shop_related_assignments-product_id}}', '{{%shop_related_assignments}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-shop_related_assignments-related_id}}', '{{%shop_related_assignments}}', 'related_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%shop_related_assignments}}');
    }
}
