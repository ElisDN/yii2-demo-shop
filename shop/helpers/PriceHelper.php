<?php

namespace shop\helpers;

class PriceHelper
{
    public static function format($price): string
    {
        return number_format($price, 0, '.', ' ');
    }
} 