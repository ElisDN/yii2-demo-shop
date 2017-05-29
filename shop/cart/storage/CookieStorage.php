<?php

namespace shop\cart\storage;

use shop\cart\CartItem;
use shop\entities\Shop\Product\Product;
use Yii;
use yii\helpers\Json;
use yii\web\Cookie;

class CookieStorage implements StorageInterface
{
    private $key;
    private $timeout;

    public function __construct($key, $timeout)
    {
        $this->key = $key;
        $this->timeout = $timeout;
    }

    public function load(): array
    {
        if ($cookie = Yii::$app->request->cookies->get($this->key)) {
            return array_filter(array_map(function (array $row) {
                if (isset($row['p'], $row['q']) && $product = Product::find()->active()->andWhere(['id' => $row['p']])->one()) {
                    /** @var Product $product */
                    return new CartItem($product, $row['m'] ?? null, $row['q']);
                }
                return false;
            }, Json::decode($cookie->value)));
        }
        return [];
    }

    public function save(array $items): void
    {
        Yii::$app->response->cookies->add(new Cookie([
            'name' => $this->key,
            'value' => Json::encode(array_map(function (CartItem $item) {
                return [
                    'p' => $item->getProductId(),
                    'm' => $item->getModificationId(),
                    'q' => $item->getQuantity(),
                ];
            }, $items)),
            'expire' => time() + $this->timeout,
        ]));
    }
} 