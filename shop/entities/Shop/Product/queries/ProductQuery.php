<?php

namespace shop\entities\Shop\Product\queries;

use shop\entities\Shop\Product\Product;
use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Product::STATUS_ACTIVE,
        ]);
    }
}