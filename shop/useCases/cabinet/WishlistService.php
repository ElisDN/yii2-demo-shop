<?php

namespace shop\useCases\cabinet;

use shop\repositories\Shop\ProductRepository;
use shop\repositories\UserRepository;

class WishlistService
{
    private $users;
    private $products;

    public function __construct(UserRepository $users, ProductRepository $products)
    {
        $this->users = $users;
        $this->products = $products;
    }

    public function add($userId, $productId): void
    {
        $user = $this->users->get($userId);
        $product = $this->products->get($productId);
        $user->addToWishList($product->id);
        $this->users->save($user);
    }

    public function remove($userId, $productId): void
    {
        $user = $this->users->get($userId);
        $product = $this->products->get($productId);
        $user->removeFromWishList($product->id);
        $this->users->save($user);
    }
}