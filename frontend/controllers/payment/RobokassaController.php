<?php

namespace frontend\controllers\payment;

use robokassa\Merchant;
use shop\entities\Shop\Order\Order;
use shop\readModels\Shop\OrderReadRepository;
use shop\useCases\Shop\OrderService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use robokassa\ResultAction;
use robokassa\SuccessAction;
use robokassa\FailAction;

class RobokassaController extends Controller
{
    public $enableCsrfValidation = false;

    private $orders;
    private $service;

    public function __construct($id, $module, OrderReadRepository $orders, OrderService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->orders = $orders;
        $this->service = $service;
    }

    public function actionInvoice($id)
    {
        $order = $this->loadModel($id);

        return $this->getMerchant()->payment($order->cost, $order->id, 'Payment', null, null);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'result' => [
                'class' => ResultAction::class,
                'callback' => [$this, 'resultCallback'],
            ],
            'success' => [
                'class' => SuccessAction::class,
                'callback' => [$this, 'successCallback'],
            ],
            'fail' => [
                'class' => FailAction::class,
                'callback' => [$this, 'failCallback'],
            ],
        ];
    }

    public function successCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        return $this->goBack();
    }

    public function resultCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $order = $this->loadModel($nInvId);
        try {
            $this->service->pay($order->id);
            return 'OK' . $nInvId;
        } catch (\DomainException $e) {
            return $e->getMessage();
        }
    }

    public function failCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $order = $this->loadModel($nInvId);
        try {
            $this->service->fail($order->id);
            return 'OK' . $nInvId;
        } catch (\DomainException $e) {
            return $e->getMessage();
        }
    }

    private function loadModel($id): Order
    {
        if (!$order = $this->orders->findOwn(\Yii::$app->user->id, $id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $order;
    }

    private function getMerchant(): Merchant
    {
         return Yii::$app->get('robokassa');
    }
}