<?php

namespace shop\listeners\Shop\Product;

use shop\entities\Shop\Product\Product;
use shop\repositories\events\EntityRemoved;
use shop\services\search\ProductIndexer;
use yii\caching\Cache;
use yii\caching\TagDependency;

class ProductSearchRemoveListener
{
    private $indexer;
    private $cache;

    public function __construct(ProductIndexer $indexer, Cache $cache)
    {
        $this->indexer = $indexer;
        $this->cache = $cache;
    }

    public function handle(EntityRemoved $event): void
    {
        if ($event->entity instanceof Product) {
            $this->indexer->remove($event->entity);
            TagDependency::invalidate($this->cache, ['products']);
        }
    }
}