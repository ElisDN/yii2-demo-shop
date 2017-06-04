<?php

namespace api\controllers\shop;

use shop\cart\Cart;
use shop\forms\Shop\Order\OrderForm;
use shop\useCases\Shop\OrderService;
use Yii;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class CheckoutController extends Controller
{
    private $cart;
    private $service;

    public function __construct($id, $module, OrderService $service, Cart $cart, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cart = $cart;
        $this->service = $service;
    }

    public function verbs(): array
    {
        return [
            'index' => ['POST'],
        ];
    }

    public function actionIndex()
    {
        $form = new OrderForm($this->cart->getWeight());

        $form->load(Yii::$app->request->getBodyParams(), '');

        if ($form->validate()) {
            try {
                $order = $this->service->checkout(Yii::$app->user->id, $form);
                $response = Yii::$app->getResponse();
                $response->setStatusCode(204);
                $response->getHeaders()->set('Location', Url::to(['shop/order/view', 'id' => $order->id], true));
                return [];
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }

        return $form;
    }
}