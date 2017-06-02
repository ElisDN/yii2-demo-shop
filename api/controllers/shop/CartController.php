<?php

namespace api\controllers\shop;

use shop\cart\CartItem;
use shop\cart\cost\Discount;
use shop\forms\Shop\AddToCartForm;
use shop\readModels\Shop\ProductReadRepository;
use shop\services\Shop\CartService;
use Yii;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class CartController extends Controller
{
    private $products;
    private $service;

    public function __construct($id, $module, CartService $service, ProductReadRepository $products, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->service = $service;
    }

    public function verbs(): array
    {
        return [
            'index' => ['GET'],
            'add' => ['GET'],
            'quantity' => ['POST'],
            'delete' => ['DELETE'],
            'clear' => ['DELETE'],
        ];
    }

    public function actionIndex(): array
    {
        $cart = $this->service->getCart();
        $cost = $cart->getCost();

        return [
            'weight' => $cart->getWeight(),
            'amount' => $cart->getAmount(),
            'items' => array_map(function (CartItem $item) {
                $product = $item->getProduct();
                $modification = $item->getModification();
                return [
                    'id' => $item->getId(),
                    'quantity' => $item->getQuantity(),
                    'price' => $item->getPrice(),
                    'cost' => $item->getCost(),
                    'product' => [
                        'id' => $product->id,
                        'code' => $product->code,
                        'name' => $product->name,
                        'thumbnail' => $product->mainPhoto ? $product->mainPhoto->getThumbFileUrl('file', 'cart_list'): null,
                        '_links' => [
                            'self' => ['href' => Url::to(['/shop/product/view', 'id' => $product->id], true)],
                        ],
                    ],
                    'modification' => $modification ? [
                        'id' => $product->id,
                        'code' => $modification->code,
                        'name' => $modification->name,
                    ] : [],
                    '_links' => [
                        'quantity' => ['href' => Url::to(['quantity', 'id' => $item->getId()], true)],
                        'remove' => ['href' => Url::to(['delete', 'id' => $item->getId()], true)],
                    ],
                ];
            }, $cart->getItems()),
            'cost' => [
                'origin' => $cost->getOrigin(),
                'discounts' => array_map(function (Discount $discount) {
                    return [
                        'name' => $discount->getName(),
                        'value' => $discount->getValue(),
                    ];
                }, $cost->getDiscounts()),
                'total' => $cost->getTotal(),
            ],
        ];
    }

    public function actionAdd($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $form = new AddToCartForm($product);
        $form->load(Yii::$app->request->getBodyParams(), '');

        if ($form->validate()) {
            try {
                $this->service->add($product->id, $form->modification, $form->quantity);
                Yii::$app->getResponse()->setStatusCode(201);
                return [];
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }

        return $form;
    }

    public function actionQuantity($id): void
    {
        try {
            $this->service->set($id, (int)Yii::$app->request->post('quantity'));
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

    public function actionDelete($id): void
    {
        try {
            $this->service->remove($id);
            Yii::$app->getResponse()->setStatusCode(204);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

    public function actionClear(): void
    {
        try {
            $this->service->clear();
            Yii::$app->getResponse()->setStatusCode(204);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }
}