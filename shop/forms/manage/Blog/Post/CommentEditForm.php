<?php

namespace shop\forms\manage\Blog\Post;

use shop\entities\Blog\Post\Comment;
use yii\base\Model;

class CommentEditForm extends Model
{
    public $parentId;
    public $text;

    public function __construct(Comment $comment, $config = [])
    {
        $this->parentId = $comment->parent_id;
        $this->text = $comment->text;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['text'], 'required'],
            ['text', 'string'],
            ['parentId', 'integer'],
        ];
    }
}