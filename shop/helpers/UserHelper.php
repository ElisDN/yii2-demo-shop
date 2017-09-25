<?php

namespace shop\helpers;

use yii\helpers\Html;
use shop\entities\User\User;

class UserHelper
{
    /**
     * @return array
     */
    public static function statusList(): array
    {
        return [
            User::STATUS_WAIT => 'Wait',
            User::STATUS_ACTIVE => 'Active',
        ];
    }

    /**
     * @param $status
     * @return null|string
     */
    public static function statusName($status): ?string
    {
        return self::statusList()[$status] ?? null;
    }

    /**
     * @param $status
     * @return string
     */
    public static function statusLabel($status): string
    {
        switch ($status) {
            case User::STATUS_WAIT:
                $class = 'label-warning';
                break;
            case User::STATUS_ACTIVE:
                $class = 'label-success';
                break;
            default:
                $class = 'label-default';
                break;
        }

        return Html::tag('span', self::statusName($status), [
            'class' => "label {$class}"
        ]);
    }
}
