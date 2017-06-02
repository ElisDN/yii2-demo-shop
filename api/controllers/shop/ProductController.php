<?php

namespace api\controllers\shop;

use api\providers\MapDataProvider;
use shop\entities\Shop\Category;
use shop\entities\Shop\Product\Modification;
use shop\entities\Shop\Product\Photo;
use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Tag;
use shop\readModels\Shop\CategoryReadRepository;
use shop\readModels\Shop\TagReadRepository;
use shop\readModels\Shop\BrandReadRepository;
use shop\readModels\Shop\ProductReadRepository;
use yii\data\DataProviderInterface;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
{
    private $products;
    private $categories;
    private $brands;
    private $tags;

    public function __construct(
        $id,
        $module,
        ProductReadRepository $products,
        CategoryReadRepository $categories,
        BrandReadRepository $brands,
        TagReadRepository $tags,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->categories = $categories;
        $this->brands = $brands;
        $this->tags = $tags;
    }

    protected function verbs(): array
    {
        return [
            'index' => ['GET'],
            'category' => ['GET'],
            'brand' => ['GET'],
            'tag' => ['GET'],
            'view' => ['GET'],
        ];
    }

    public function actionIndex(): DataProviderInterface
    {
        $dataProvider = $this->products->getAll();
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    public function actionCategory($id): DataProviderInterface
    {
        if (!$category = $this->categories->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByCategory($category);
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    public function actionBrand($id): DataProviderInterface
    {
        if (!$brand = $this->brands->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByBrand($brand);
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    public function actionTag($id): DataProviderInterface
    {
        if (!$tag = $this->tags->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByTag($tag);
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    public function actionView($id): array
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->serializeView($product);
    }

    public function serializeListItem(Product $product): array
    {
        return [
            'id' => $product->id,
            'code' => $product->code,
            'name' => $product->name,
            'category' => [
                'id' => $product->category->id,
                'name' => $product->category->name,
                '_links' => [
                    'self' => ['href' => Url::to(['category', 'id' => $product->category->id], true)],
                ],
            ],
            'brand' => [
                'id' => $product->brand->id,
                'name' => $product->brand->name,
                '_links' => [
                    'self' => ['href' => Url::to(['brand', 'id' => $product->brand->id], true)],
                ],
            ],
            'price' => [
                'new' => $product->price_new,
                'old' => $product->price_old,
            ],
            'thumbnail' => $product->mainPhoto ? $product->mainPhoto->getThumbFileUrl('file', 'catalog_list'): null,
            '_links' => [
                'self' => ['href' => Url::to(['view', 'id' => $product->id], true)],
                'wish' => ['href' => Url::to(['/shop/wishlist/add', 'id' => $product->id], true)],
                'cart' => ['href' => Url::to(['/shop/cart/add', 'id' => $product->id], true)],
            ],
        ];
    }

    private function serializeView(Product $product): array
    {
        return [
            'id' => $product->id,
            'code' => $product->code,
            'name' => $product->name,
            'description' => $product->description,
            'categories' => [
                'main' => [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                    '_links' => [
                        'self' => ['href' => Url::to(['category', 'id' => $product->category->id], true)],
                    ],
                ],
                'other' => array_map(function (Category $category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        '_links' => [
                            'self' => ['href' => Url::to(['category', 'id' => $category->id], true)],
                        ],
                    ];
                }, $product->categories),
            ],
            'brand' => [
                'id' => $product->brand->id,
                'name' => $product->brand->name,
                '_links' => [
                    'self' => ['href' => Url::to(['brand', 'id' => $product->brand->id], true)],
                ],
            ],
            'tags' => array_map(function (Tag $tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    '_links' => [
                        'self' => ['href' => Url::to(['tag', 'id' => $tag->id], true)],
                    ],
                ];
            }, $product->tags),
            'price' => [
                'new' => $product->price_new,
                'old' => $product->price_old,
            ],
            'photos' => array_map(function (Photo $photo) {
                return [
                    'thumbnail' => $photo->getThumbFileUrl('file', 'catalog_list'),
                    'origin' => $photo->getThumbFileUrl('file', 'catalog_origin'),
                ];
            }, $product->photos),
            'modifications' => array_map(function (Modification $modification) use ($product) {
                return [
                    'id' => $modification->id,
                    'code' => $modification->code,
                    'name' => $modification->name,
                    'price' => $product->getModificationPrice($modification->id),
                ];
            }, $product->modifications),
            'rating' => $product->rating,
            'weight' => $product->weight,
            'quantity' => $product->quantity,
            '_links' => [
                'self' => ['href' => Url::to(['view', 'id' => $product->id], true)],
                'wish' => ['href' => Url::to(['/shop/wishlist/add', 'id' => $product->id], true)],
                'cart' => ['href' => Url::to(['/shop/cart/add', 'id' => $product->id], true)],
            ],
        ];
    }
}