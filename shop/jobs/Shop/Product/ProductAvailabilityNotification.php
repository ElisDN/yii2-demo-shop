<?php

namespace shop\jobs\Shop\Product;

use shop\entities\Shop\Product\Product;
use shop\jobs\Job;

class ProductAvailabilityNotification extends Job
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}