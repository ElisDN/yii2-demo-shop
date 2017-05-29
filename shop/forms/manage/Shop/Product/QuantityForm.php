<?php

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Product\Product;
use yii\base\Model;

class QuantityForm extends Model
{
    public $quantity;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->quantity = $product->quantity;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['quantity'], 'required'],
            [['quantity'], 'integer', 'min' => 0],
        ];
    }
}