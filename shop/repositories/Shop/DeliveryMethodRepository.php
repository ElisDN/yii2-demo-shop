<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\DeliveryMethod;
use shop\repositories\NotFoundException;

class DeliveryMethodRepository
{
    public function get($id): DeliveryMethod
    {
        if (!$method = DeliveryMethod::findOne($id)) {
            throw new NotFoundException('DeliveryMethod is not found.');
        }
        return $method;
    }

    public function findByName($name): ?DeliveryMethod
    {
        return DeliveryMethod::findOne(['name' => $name]);
    }

    public function save(DeliveryMethod $method): void
    {
        if (!$method->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(DeliveryMethod $method): void
    {
        if (!$method->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}