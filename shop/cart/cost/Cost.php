<?php

namespace shop\cart\cost;

final class Cost
{
    private $value;
    private $discounts = [];

    public function __construct(float $value, array $discounts = [])
    {
        $this->value = $value;
        $this->discounts = $discounts;
    }

    public function withDiscount(Discount $discount): self
    {
        return new static($this->value, array_merge($this->discounts, [$discount]));
    }

    public function getOrigin(): float
    {
        return $this->value;
    }

    public function getTotal(): float
    {
        return $this->value - array_sum(array_map(function (Discount $discount) {
            return $discount->getValue();
        }, $this->discounts));
    }

    /**
     * @return Discount[]
     */
    public function getDiscounts(): array
    {
        return $this->discounts;
    }
}