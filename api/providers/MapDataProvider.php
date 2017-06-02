<?php

namespace api\providers;

use yii\base\Object;
use yii\data\DataProviderInterface;
use yii\data\Pagination;
use yii\data\Sort;

/**
 * @property int $count
 * @property array $keys
 * @property array $models
 * @property Pagination|false $pagination
 * @property Sort|bool $sort
 * @property int $totalCount
 */
class MapDataProvider extends Object implements DataProviderInterface
{
    private $next;
    private $callback;

    public function __construct(DataProviderInterface $next, callable $callback)
    {
        $this->next = $next;
        $this->callback = $callback;
        parent::__construct();
    }

    public function prepare($forcePrepare = false): void
    {
        $this->next->prepare($forcePrepare);
    }

    public function getCount(): int
    {
        return $this->next->getCount();
    }

    public function getTotalCount(): int
    {
        return $this->next->getTotalCount();
    }

    public function getModels(): array
    {
        return array_map($this->callback, $this->next->getModels());
    }

    public function getKeys(): array
    {
        return $this->next->getKeys();
    }

    public function getSort()
    {
        return $this->next->getSort();
    }

    public function getPagination()
    {
        return $this->next->getPagination();
    }
}