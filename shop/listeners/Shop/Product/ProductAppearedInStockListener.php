<?php

namespace shop\listeners\Shop\Product;

use shop\entities\Shop\Product\events\ProductAppearedInStock;
use shop\jobs\Shop\Product\ProductAvailabilityNotification;
use shop\repositories\UserRepository;

use yii\queue\Queue;

class ProductAppearedInStockListener
{
    private $queue;

    public function __construct(UserRepository $users, Queue $queue)
    {
        $this->queue = $queue;
    }

    public function handle(ProductAppearedInStock $event): void
    {
        if ($event->product->isActive()) {
            $this->queue->push(new ProductAvailabilityNotification($event->product));
        }
    }
}