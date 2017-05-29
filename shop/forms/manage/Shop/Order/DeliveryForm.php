<?php

namespace shop\forms\manage\Shop\Order;

use shop\entities\Shop\DeliveryMethod;
use shop\entities\Shop\Order\Order;
use shop\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DeliveryForm extends Model
{
    public $method;
    public $index;
    public $address;

    private $_order;

    public function __construct(Order $order, array $config = [])
    {
        $this->method = $order->delivery_method_id;
        $this->index = $order->deliveryData->index;
        $this->address = $order->deliveryData->address;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['method'], 'integer'],
            [['index', 'address'], 'required'],
            [['index'], 'string', 'max' => 255],
            [['address'], 'string'],
        ];
    }

    public function deliveryMethodsList(): array
    {
        $methods = DeliveryMethod::find()->orderBy('sort')->all();

        return ArrayHelper::map($methods, 'id', function (DeliveryMethod $method) {
            return $method->name . ' (' . PriceHelper::format($method->cost) . ')';
        });
    }
}