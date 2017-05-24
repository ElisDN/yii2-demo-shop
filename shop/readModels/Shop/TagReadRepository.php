<?php

namespace shop\readModels\Shop;

use shop\entities\Shop\Tag;

class TagReadRepository
{
    public function find($id): ?Tag
    {
        return Tag::findOne($id);
    }
}