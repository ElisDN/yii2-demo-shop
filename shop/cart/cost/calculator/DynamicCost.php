<?php

namespace shop\cart\cost\calculator;

use shop\cart\cost\Cost;
use shop\cart\cost\Discount as CartDiscount;
use shop\entities\Shop\Discount as DiscountEntity;

class DynamicCost implements CalculatorInterface
{
    private $next;

    public function __construct(CalculatorInterface $next)
    {
        $this->next = $next;
    }

    public function getCost(array $items): Cost
    {
        /** @var DiscountEntity[] $discounts */
        $discounts = DiscountEntity::find()->active()->orderBy('sort')->all();

        $cost = $this->next->getCost($items);

        foreach ($discounts as $discount) {
            if ($discount->isEnabled()) {
                $new = new CartDiscount($cost->getOrigin() * $discount->percent / 100, $discount->name);
                $cost = $cost->withDiscount($new);
            }
        }

        return $cost;
    }
}