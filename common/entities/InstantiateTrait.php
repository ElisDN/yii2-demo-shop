<?php

namespace common\entities;

trait InstantiateTrait
{
    private static $_prototype;

    public static function instantiate($row)
    {
        if (self::$_prototype === null) {
            $class = get_called_class();
            self::$_prototype = unserialize(sprintf('O:%d:"%s":0:{}', strlen($class), $class));
        }
        $entity = clone self::$_prototype;
        $entity->init();
        return $entity;
    }
}