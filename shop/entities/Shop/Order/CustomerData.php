<?php

namespace shop\entities\Shop\Order;

class CustomerData
{
    public $phone;
    public $name;

    public function __construct($phone, $name)
    {
        $this->phone = $phone;
        $this->name = $name;
    }
}