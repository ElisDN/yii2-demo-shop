<?php

namespace shop\services\Shop;

use shop\cart\Cart;
use shop\cart\CartItem;
use shop\forms\Shop\AddToCartForm;
use shop\repositories\Shop\ProductRepository;

class CartService
{
    private $cart;
    private $products;

    public function __construct(Cart $cart, ProductRepository $products)
    {
        $this->cart = $cart;
        $this->products = $products;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function add($productId, AddToCartForm $form): void
    {
        $product = $this->products->get($productId);
        $modification = $product->getModification($form->modification);
        $this->cart->add(new CartItem($product, $modification->id, $form->quantity));
    }

    public function set($id, $quantity): void
    {
        $this->cart->set($id, $quantity);
    }

    public function remove($id): void
    {
        $this->cart->remove($id);
    }

    public function clear(): void
    {
        $this->cart->clear();
    }
}