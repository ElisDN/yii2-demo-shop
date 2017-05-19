<?php

namespace shop\helpers;

use shop\entities\Shop\Characteristic;
use yii\helpers\ArrayHelper;

class CharacteristicHelper
{
    public static function typeList(): array
    {
        return [
            Characteristic::TYPE_STRING => 'String',
            Characteristic::TYPE_INTEGER => 'Integer number',
            Characteristic::TYPE_FLOAT => 'Float number',
        ];
    }

    public static function typeName($type): string
    {
        return ArrayHelper::getValue(self::typeList(), $type);
    }
}