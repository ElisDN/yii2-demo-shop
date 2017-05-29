<?php

namespace shop\entities\Shop\Order;

class DeliveryData
{
    public $index;
    public $address;

    public function __construct($index, $address)
    {
        $this->index = $index;
        $this->address = $address;
    }
}