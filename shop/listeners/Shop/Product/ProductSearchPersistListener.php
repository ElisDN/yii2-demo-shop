<?php

namespace shop\listeners\Shop\Product;

use shop\entities\Shop\Product\Product;
use shop\repositories\events\EntityPersisted;
use shop\services\search\ProductIndexer;

class ProductSearchPersistListener
{
    private $indexer;

    public function __construct(ProductIndexer $indexer)
    {
        $this->indexer = $indexer;
    }

    public function handle(EntityPersisted $event): void
    {
        if ($event->entity instanceof Product) {
            if ($event->entity->isActive()) {
                $this->indexer->index($event->entity);
            } else {
                $this->indexer->remove($event->entity);
            }
        }
    }
}