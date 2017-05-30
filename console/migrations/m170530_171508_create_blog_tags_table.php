<?php

use yii\db\Migration;

class m170530_171508_create_blog_tags_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%blog_tags}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-blog_tags-slug}}', '{{%blog_tags}}', 'slug', true);
    }

    public function down()
    {
        $this->dropTable('{{%blog_tags}}');
    }
}
