<?php

use yii\db\Migration;

class m170531_085557_create_blog_comments_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        
        $this->createTable('{{%blog_comments}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'text' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-blog_comments-post_id}}', '{{%blog_comments}}', 'post_id');
        $this->createIndex('{{%idx-blog_comments-user_id}}', '{{%blog_comments}}', 'user_id');
        $this->createIndex('{{%idx-blog_comments-parent_id}}', '{{%blog_comments}}', 'parent_id');

        $this->addForeignKey('{{%fk-blog_comments-post_id}}', '{{%blog_comments}}', 'post_id', '{{%blog_posts}}', 'id', 'CASCADE');
        $this->addForeignKey('{{%fk-blog_comments-user_id}}', '{{%blog_comments}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
        $this->addForeignKey('{{%fk-blog_comments-parent_id}}', '{{%blog_comments}}', 'parent_id', '{{%blog_comments}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%blog_comments}}');
    }
}
