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

    /**
     * @SWG\Get(
     *     path="/shop/products",
     *     tags={"Catalog"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/ProductItem")
     *         ),
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function actionIndex(): DataProviderInterface
    {
        $dataProvider = $this->products->getAll();
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    /**
     * @SWG\Get(
     *     path="/shop/products/category/{categoryId}",
     *     tags={"Catalog"},
     *     @SWG\Parameter(name="categoryId", in="path", required=true, type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/ProductItem")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param $id
     * @return DataProviderInterface
     * @throws NotFoundHttpException
     */
    public function actionCategory($id): DataProviderInterface
    {
        if (!$category = $this->categories->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByCategory($category);
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    /**
     * @SWG\Get(
     *     path="/shop/products/brand/{brandId}",
     *     tags={"Catalog"},
     *     @SWG\Parameter(name="brandId", in="path", required=true, type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/ProductItem")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param $id
     * @return DataProviderInterface
     * @throws NotFoundHttpException
     */
    public function actionBrand($id): DataProviderInterface
    {
        if (!$brand = $this->brands->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByBrand($brand);
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    /**
     * @SWG\Get(
     *     path="/shop/products/tag/{tagId}",
     *     tags={"Catalog"},
     *     @SWG\Parameter(name="tagId", in="path", required=true, type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/ProductItem")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param $id
     * @return DataProviderInterface
     * @throws NotFoundHttpException
     */
    public function actionTag($id): DataProviderInterface
    {
        if (!$tag = $this->tags->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByTag($tag);
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    /**
     * @SWG\Get(
     *     path="/shop/products/{productId}",
     *     tags={"Catalog"},
     *     @SWG\Parameter(
     *         name="productId",
     *         description="ID of product",
     *         in="path",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(ref="#/definitions/ProductView")
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * 
     * @param $id
     * @return array
     * @throws NotFoundHttpException
     */
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

/**
 * @SWG\Definition(
 *     definition="ProductItem",
 *     type="object",
 *     @SWG\Property(property="id", type="integer"),
 *     @SWG\Property(property="code", type="string"),
 *     @SWG\Property(property="name", type="string"),
 *     @SWG\Property(property="category", ref="#/definitions/ProductCategory"),
 *     @SWG\Property(property="brand", ref="#/definitions/ProductBrand"),
 *     @SWG\Property(property="price", ref="#/definitions/ProductPrice"),
 *     @SWG\Property(property="thumbnail", type="string"),
 *     @SWG\Property(property="_links", type="object",
 *         @SWG\Property(property="self", type="object", @SWG\Property(property="href", type="string")),
 *     ),
 * )
 *
 * @SWG\Definition(
 *     definition="ProductView",
 *     type="object",
 *     @SWG\Property(property="id", type="integer"),
 *     @SWG\Property(property="code", type="string"),
 *     @SWG\Property(property="name", type="string"),
 *     @SWG\Property(property="description", type="string"),
 *     @SWG\Property(property="categories", type="object",
 *         @SWG\Property(property="main", ref="#/definitions/ProductCategory"),
 *         @SWG\Property(property="other", type="array", @SWG\Items(ref="#/definitions/ProductCategory")),
 *     ),
 *     @SWG\Property(property="brand", ref="#/definitions/ProductBrand"),
 *     @SWG\Property(property="tags", type="array", @SWG\Items(ref="#/definitions/ProductTag")),
 *     @SWG\Property(property="photos", type="array", @SWG\Items(ref="#/definitions/ProductPhoto")),
 *     @SWG\Property(property="_links", type="object",
 *         @SWG\Property(property="self", type="object", @SWG\Property(property="href", type="string")),
 *     ),
 * )
 *
 * @SWG\Definition(
 *     definition="ProductCategory",
 *     type="object",
 *     @SWG\Property(property="id", type="integer"),
 *     @SWG\Property(property="name", type="string"),
 *     @SWG\Property(property="_links", type="object",
 *         @SWG\Property(property="self", type="object", @SWG\Property(property="href", type="string")),
 *     ),
 * )
 *
 * @SWG\Definition(
 *     definition="ProductBrand",
 *     type="object",
 *     @SWG\Property(property="id", type="integer"),
 *     @SWG\Property(property="name", type="string"),
 *     @SWG\Property(property="_links", type="object",
 *         @SWG\Property(property="self", type="object", @SWG\Property(property="href", type="string")),
 *     ),
 * )
 *
 * @SWG\Definition(
 *     definition="ProductTag",
 *     type="object",
 *     @SWG\Property(property="id", type="integer"),
 *     @SWG\Property(property="name", type="string"),
 *     @SWG\Property(property="_links", type="object",
 *         @SWG\Property(property="self", type="object", @SWG\Property(property="href", type="string")),
 *     ),
 * )
 *
 * @SWG\Definition(
 *     definition="ProductPrice",
 *     type="object",
 *     @SWG\Property(property="new", type="integer"),
 *     @SWG\Property(property="old", type="integer"),
 * )
 *
 * @SWG\Definition(
 *     definition="ProductPhoto",
 *     type="object",
 *     @SWG\Property(property="thumbnail", type="string"),
 *     @SWG\Property(property="origin", type="string"),
 * )
 */