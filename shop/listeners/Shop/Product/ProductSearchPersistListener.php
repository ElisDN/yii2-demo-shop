<?php

namespace shop\listeners\Shop\Product;

use shop\entities\Shop\Product\Product;
use shop\repositories\events\EntityPersisted;
use shop\services\search\ProductIndexer;
use yii\caching\Cache;
use yii\caching\TagDependency;

class ProductSearchPersistListener
{
    private $indexer;
    private $cache;

    public function __construct(ProductIndexer $indexer, Cache $cache)
    {
        $this->indexer = $indexer;
        $this->cache = $cache;
    }

    public function handle(EntityPersisted $event): void
    {
        if ($event->entity instanceof Product) {
            if ($event->entity->isActive()) {
                $this->indexer->index($event->entity);
            } else {
                $this->indexer->remove($event->entity);
            }
            TagDependency::invalidate($this->cache, ['products']);
        }
    }
}