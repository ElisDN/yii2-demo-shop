<?php

namespace shop\readModels\Shop;

use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\QueryInterface;

class SimpleActiveDataProvider extends ActiveDataProvider
{
    public $totalCount;

    protected function prepareModels()
    {
        if (!$this->query instanceof QueryInterface) {
            throw new InvalidConfigException('The "query" property must be an instance of a class that implements the QueryInterface e.g. yii\db\Query or its subclasses.');
        }
        if (($pagination = $this->getPagination()) !== false) {
            $pagination->totalCount = $this->getTotalCount();
        }

        return $this->query->all($this->db);
    }

    protected function prepareTotalCount()
    {
        if ($this->totalCount === null) {
            throw new InvalidConfigException('The "totalCount" property must be set.');
        }

        return $this->totalCount;
    }
}