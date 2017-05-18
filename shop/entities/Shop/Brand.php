<?php

namespace shop\entities\Shop;

use shop\entities\Meta;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property Meta $meta
 */
class Brand extends ActiveRecord
{
    public $meta;

    public static function create($name, $slug, Meta $meta): self
    {
        $brand = new static();
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->meta = $meta;
        return $brand;
    }

    public function edit($name, $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    ##########################

    public static function tableName(): string
    {
        return '{{%shop_brands}}';
    }

    public function afterFind(): void
    {
        $meta = Json::decode($this->getAttribute('meta_json'));
        $this->meta = new Meta($meta['title'], $meta['description'], $meta['keywords']);
        parent::afterFind();
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('meta_json', Json::encode([
            'title' => $this->meta->title,
            'description' => $this->meta->description,
            'keywords' => $this->meta->keywords,
        ]));
        return parent::beforeSave($insert);
    }
}