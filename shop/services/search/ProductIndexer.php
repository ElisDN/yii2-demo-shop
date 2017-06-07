<?php

namespace shop\services\search;

use Elasticsearch\Client;
use shop\entities\Shop\Category;
use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Product\Value;
use yii\helpers\ArrayHelper;

class ProductIndexer
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function clear(): void
    {
        $this->client->deleteByQuery([
            'index' => 'shop',
            'type' => 'products',
            'body' => [
                'query' => [
                    'match_all' => new \stdClass(),
                ],
            ],
        ]);
    }

    public function index(Product $product): void
    {
        $this->client->index([
            'index' => 'shop',
            'type' => 'products',
            'id' => $product->id,
            'body' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => strip_tags($product->description),
                'price' => $product->price_new,
                'rating' => $product->rating,
                'brand' => $product->brand_id,
                'categories' => ArrayHelper::merge(
                    [$product->category->id],
                    ArrayHelper::getColumn($product->category->parents, 'id'),
                    ArrayHelper::getColumn($product->categoryAssignments, 'category_id'),
                    array_reduce(array_map(function (Category $category) {
                        return ArrayHelper::getColumn($category->parents, 'id');
                    }, $product->categoryAssignments),'array_merge', [])
                ),
                'tags' => ArrayHelper::getColumn($product->tagAssignments, 'tag_id'),
                'values' => array_map(function (Value $value) {
                    return [
                        'characteristic' => $value->characteristic_id,
                        'value_string' => (string)$value->value,
                        'value_int' => (int)$value->value,
                    ];
                }, $product->values),
            ],
        ]);
    }

    public function remove(Product $product): void
    {
        $this->client->delete([
            'index' => 'shop',
            'type' => 'products',
            'id' => $product->id,
        ]);
    }
}