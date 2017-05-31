<?php

namespace shop\repositories\Blog;

use shop\entities\Blog\Post\Post;
use shop\repositories\NotFoundException;

class PostRepository
{
    public function get($id): Post
    {
        if (!$brand = Post::findOne($id)) {
            throw new NotFoundException('Post is not found.');
        }
        return $brand;
    }

    public function existsByCategory($id): bool
    {
        return Post::find()->andWhere(['category_id' => $id])->exists();
    }

    public function save(Post $brand): void
    {
        if (!$brand->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Post $brand): void
    {
        if (!$brand->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}