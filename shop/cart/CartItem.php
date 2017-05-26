<?php

namespace shop\cart;

use shop\entities\Shop\Product\Modification;
use shop\entities\Shop\Product\Product;

class CartItem
{
    private $product;
    private $modificationId;
    private $quantity;

    public function __construct(Product $product, $modificationId, $quantity)
    {
        $this->product = $product;
        $this->modificationId = $modificationId;
        $this->quantity = $quantity;
    }

    public function getId(): string
    {
        return md5(serialize([$this->product->id, $this->modificationId]));
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getModification(): ?Modification
    {
        if ($this->modificationId) {
            return $this->product->getModification($this->modificationId);
        }
        return null;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): int
    {
        if ($this->modificationId) {
            return $this->product->getModificationPrice($this->modificationId);
        }
        return $this->product->price_new;
    }

    public function getCost(): int
    {
        return $this->getPrice() * $this->quantity;
    }

    public function plus($quantity)
    {
        return new static($this->product, $this->modificationId, $this->quantity + $quantity);
    }

    public function changeQuantity($quantity)
    {
        return new static($this->product, $this->modificationId, $quantity);
    }
}