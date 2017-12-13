<?php

use yii\db\Migration;

class m170519_212444_create_shop_reviews_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_reviews}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->unsigned()->notNull(),
<<<<<<< HEAD
=======
            'product_id' => $this->integer()->notNull(),
>>>>>>> d08247c609e5dba11230429d7d547afccee64093
            'user_id' => $this->integer()->notNull(),
            'vote' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull(),
        ], $tableOptions);

<<<<<<< HEAD
        $this->createIndex('{{%idx-shop_reviews-user_id}}', '{{%shop_reviews}}', 'user_id');

=======
        $this->createIndex('{{%idx-shop_reviews-product_id}}', '{{%shop_reviews}}', 'product');
        $this->createIndex('{{%idx-shop_reviews-user_id}}', '{{%shop_reviews}}', 'user_id');

        $this->addForeignKey('{{%fk-shop_reviews-product_id}}', '{{%shop_reviews}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
>>>>>>> d08247c609e5dba11230429d7d547afccee64093
        $this->addForeignKey('{{%fk-shop_reviews-user_id}}', '{{%shop_reviews}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%shop_reviews}}');
    }
}
