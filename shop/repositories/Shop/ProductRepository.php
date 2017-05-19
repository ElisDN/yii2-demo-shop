<?php

namespace shop\repositories;

use shop\entities\Shop\Product\Product;

class ProductRepository
{
    public function get($id): Product
    {
        if (!$brand = Product::findOne($id)) {
            throw new NotFoundException('Product is not found.');
        }
        return $brand;
    }

    public function save(Product $brand): void
    {
        if (!$brand->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Product $brand): void
    {
        if (!$brand->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}