<?php

namespace api\controllers\shop;

use api\providers\MapDataProvider;
use shop\entities\Shop\Product\Product;
use shop\readModels\Shop\ProductReadRepository;
use shop\services\cabinet\WishlistService;
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

    public function actionIndex(): DataProviderInterface
    {
        $dataProvider = $this->products->getWishList(\Yii::$app->user->id);
        return new MapDataProvider($dataProvider, [$this, 'serializeListItem']);
    }

    public function actionAdd($id): void
    {
        try {
            $this->service->add(Yii::$app->user->id, $id);
            Yii::$app->getResponse()->setStatusCode(201);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

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