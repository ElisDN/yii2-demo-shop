<?php

use yii\db\Migration;

class m170519_183603_create_shop_category_assignments_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_category_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-shop_category_assignments}}', '{{%shop_category_assignments}}', ['product_id', 'category_id']);
        
        $this->createIndex('{{%idx-shop_category_assignments-product_id}}', '{{%shop_category_assignments}}', 'product_id');
        $this->createIndex('{{%idx-shop_category_assignments-category_id}}', '{{%shop_category_assignments}}', 'category_id');

        $this->addForeignKey('{{%fk-shop_category_assignments-product_id}}', '{{%shop_category_assignments}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-shop_category_assignments-category_id}}', '{{%shop_category_assignments}}', 'category_id', '{{%shop_categories}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%shop_category_assignments}}');
    }
}
