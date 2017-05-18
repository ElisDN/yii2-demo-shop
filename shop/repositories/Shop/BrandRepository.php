<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Brand;
use shop\repositories\NotFoundException;

class BrandRepository
{
    public function get($id): Brand
    {
        if (!$brand = Brand::findOne($id)) {
            throw new NotFoundException('Brand is not found.');
        }
        return $brand;
    }

    public function save(Brand $brand): void
    {
        if (!$brand->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Brand $brand): void
    {
        if (!$brand->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}