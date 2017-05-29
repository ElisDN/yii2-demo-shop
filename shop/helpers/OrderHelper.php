<?php

namespace shop\helpers;

use shop\entities\Shop\Order\Status;
use shop\entities\Shop\Product\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class OrderHelper
{
    public static function statusList(): array
    {
        return [
            Status::NEW => 'New',
            Status::PAID => 'Paid',
            Status::SENT => 'Sent',
            Status::COMPLETED => 'Completed',
            Status::CANCELLED => 'Cancelled',
            Status::CANCELLED_BY_CUSTOMER => 'Cancelled by customer',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Product::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Product::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}