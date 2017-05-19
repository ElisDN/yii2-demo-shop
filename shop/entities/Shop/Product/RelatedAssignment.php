<?php

namespace shop\entities\Shop\Product;

/**
 * @property integer $product_id;
 * @property integer $related_id;
 */
class RelatedAssignment
{
    public static function create($productId): self
    {
        $assignment = new static();
        $assignment->related_id = $productId;
        return $assignment;
    }

    public function isForProduct($id): bool
    {
        return $this->related_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_related_assignments}}';
    }
}