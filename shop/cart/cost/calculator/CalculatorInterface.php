<?php

namespace shop\cart\cost\calculator;

use shop\cart\CartItem;
use shop\cart\cost\Cost;

interface CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return Cost
     */
    public function  getCost(array $items): Cost;
} 