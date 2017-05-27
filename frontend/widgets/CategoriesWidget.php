<?php

namespace frontend\widgets;

use Elasticsearch\Client;
use shop\entities\Shop\Category;
use shop\readModels\Shop\CategoryReadRepository;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class CategoriesWidget extends Widget
{
    /** @var Category|null */
    public $active;

    private $categories;
    private $client;

    public function __construct(CategoryReadRepository $categories, Client $client, $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;
        $this->client = $client;
    }

    public function run(): string
    {
        $aggs = $this->client->search([
            'index' => 'shop',
            'type' => 'products',
            'body' => [
                'size' => 0,
                'aggs' => [
                    'group_by_category' => [
                        'terms' => [
                            'field' => 'categories'
                        ]
                    ]
                ],
            ],
        ]);

        $counts = ArrayHelper::map($aggs['aggregations']['group_by_category']['buckets'], 'key', 'doc_count');

        return Html::tag('div', implode(PHP_EOL, array_map(function (Category $category) use ($counts) {
            $indent = ($category->depth > 1 ? str_repeat('&nbsp;&nbsp;&nbsp;', $category->depth - 1) . '- ' : '');
            $active = $this->active && ($this->active->id == $category->id || $this->active->isChildOf($category));
            $count = ArrayHelper::getValue($counts, $category->id, 0);
            return Html::a(
                $indent . Html::encode($category->name) . ' (' . $count . ')',
                ['/shop/catalog/category', 'id' => $category->id],
                ['class' => $active ? 'list-group-item active' : 'list-group-item']
            );
        }, $this->categories->getTreeWithSubsOf($this->active))), [
            'class' => 'list-group',
        ]);
    }
}