<?php

namespace shop\readModels;

use shop\entities\Page;

class PageReadRepository
{
    public function getAll(): array
    {
        return Page::find()->andWhere(['>', 'depth', 0])->all();
    }

    public function find($id): ?Page
    {
        return Page::findOne($id);
    }

    public function findBySlug($slug): ?Page
    {
        return Page::find()->andWhere(['slug' => $slug])->andWhere(['>', 'depth', 0])->one();
    }
}