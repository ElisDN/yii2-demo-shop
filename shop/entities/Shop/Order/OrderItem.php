<?php

namespace shop\entities\Shop\Order;

use shop\entities\Shop\Product\Product;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $modification_id
 * @property string $product_name
 * @property string $product_code
 * @property string $modification_name
 * @property string $modification_code
 * @property int $price
 * @property int $quantity
 */
class OrderItem extends ActiveRecord
{
    public static function create(Product $product, $modificationId, $price, $quantity)
    {
        $item = new static();
        $item->product_id = $product->id;
        $item->product_name = $product->name;
        $item->product_code = $product->code;
        if ($modificationId) {
            $modification = $product->getModification($modificationId);
            $item->modification_id = $modification->id;
            $item->modification_name = $modification->name;
            $item->modification_code = $modification->code;
        }
        $item->price = $price;
        $item->quantity = $quantity;
        return $item;
    }

    public function getCost(): int
    {
        return $this->price * $this->quantity;
    }

    public static function tableName(): string
    {
        return '{{%shop_order_items}}';
    }
}