<?php

namespace api\controllers\shop;

use api\providers\MapDataProvider;
use shop\entities\Shop\Product\Product;
use shop\readModels\Shop\ProductReadRepository;
use shop\useCases\cabinet\WishlistService;
use Yii;
use yii\data\DataProviderInterface;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\rest\Controller;

class WishlistController extends Controller
{
    private $service;
    private $products;

    public function __construct($id, $module, WishlistService $service, ProductReadRepository $products, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->products = $products;
    }

    public function verbs(): array
    {
        return  [
            'index' => ['GET'],
            'add' => ['POST'],
            'delete' => ['DELETE'],
        ];
    }

    /**
     * @SWG\Get(
     *     path="/shop/wishlist",
     *     tags={"WishList"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/WishlistItem")
     *         ),
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function actionIndex(): DataProviderInterface
    {
        $dataProvider = $this->products->getWishList(\Yii::$app->user->id);
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    /**
     * @SWG\Post(
     *     path="/shop/products/{productId}/wish",
     *     tags={"WishList"},
     *     @SWG\Parameter(name="productId", in="path", required=true, type="integer"),
     *     @SWG\Response(
     *         response=201,
     *         description="Success response",
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param $id
     * @throws BadRequestHttpException
     */
    public function actionAdd($id): void
    {
        try {
            $this->service->add(Yii::$app->user->id, $id);
            Yii::$app->getResponse()->setStatusCode(201);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

    /**
     * @SWG\Delete(
     *     path="/shop/wishlist/{id}",
     *     tags={"WishList"},
     *     @SWG\Parameter(name="id", in="path", required=true, type="integer"),
     *     @SWG\Response(
     *         response=204,
     *         description="Success response",
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param $id
     * @throws BadRequestHttpException
     */
    public function actionDelete($id): void
    {
        try {
            $this->service->remove(Yii::$app->user->id, $id);
            Yii::$app->getResponse()->setStatusCode(204);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

    public function serializeListItem(Product $product): array
    {
        return [
            'id' => $product->id,
            'code' => $product->code,
            'name' => $product->name,
            'price' => [
                'new' => $product->price_new,
                'old' => $product->price_old,
            ],
            'thumbnail' => $product->mainPhoto ? $product->mainPhoto->getThumbFileUrl('file', 'cart_list'): null,
            '_links' => [
                'self' => ['href' => Url::to(['/shop/product/view', 'id' => $product->id], true)],
                'cart' => ['href' => Url::to(['/shop/cart/add', 'id' => $product->id], true)],
            ],
        ];
    }
}

/**
 * @SWG\Definition(
 *     definition="WishlistItem",
 *     type="object",
 *     @SWG\Property(property="id", type="integer"),
 *     @SWG\Property(property="code", type="string"),
 *     @SWG\Property(property="name", type="string"),
 *     @SWG\Property(property="price", type="object",
 *         @SWG\Property(property="new", type="integer"),
 *         @SWG\Property(property="old", type="integer"),
 *     ),
 *     @SWG\Property(property="thumbnail", type="string"),
 *     @SWG\Property(property="_links", type="object",
 *         @SWG\Property(property="self", type="object", @SWG\Property(property="href", type="string")),
 *         @SWG\Property(property="cart", type="object", @SWG\Property(property="href", type="string")),
 *     ),
 * )
 */