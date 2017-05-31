<?php

namespace shop\readModels\Blog;

use shop\entities\Blog\Category;
use shop\entities\Blog\Post\Post;
use shop\entities\Blog\Tag;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class PostReadRepository
{
    public function getAll(): DataProviderInterface
    {
        $query = Post::find()->active()->with('category');
        return $this->getProvider($query);
    }

    public function getAllByCategory(Category $category): DataProviderInterface
    {
        $query = Post::find()->active()->andWhere(['category_id' => $category->id])->with('category');
        return $this->getProvider($query);
    }

    public function getAllByTag(Tag $tag): DataProviderInterface
    {
        $query = Post::find()->alias('p')->active('p')->with('category');
        $query->joinWith(['tagAssignments ta'], false);
        $query->andWhere(['ta.tag_id' => $tag->id]);
        $query->groupBy('p.id');
        return $this->getProvider($query);
    }

    public function getLast($limit): array
    {
        return Post::find()->with('category')->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    public function getPopular($limit): array
    {
        return Post::find()->with('category')->orderBy(['comments_count' => SORT_DESC])->limit($limit)->all();
    }

    public function find($id): ?Post
    {
        return Post::find()->active()->andWhere(['id' => $id])->one();
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);
    }
}