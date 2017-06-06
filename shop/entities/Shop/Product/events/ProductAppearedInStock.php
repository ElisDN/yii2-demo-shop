<?php

namespace shop\entities\Shop\Product\events;

use shop\entities\Shop\Product\Product;

class ProductAppearedInStock
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}