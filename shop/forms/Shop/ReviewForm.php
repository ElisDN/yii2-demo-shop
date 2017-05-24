<?php

namespace shop\forms\Shop;

use shop\entities\Shop\Product\Modification;
use shop\entities\Shop\Product\Product;
use shop\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class ReviewForm extends Model
{
    public $vote;
    public $text;

    public function rules(): array
    {
        return [
            [['vote', 'text'], 'required'],
            [['vote'], 'in', 'range' => array_keys($this->votesList())],
            ['text', 'string'],
        ];
    }

    public function votesList(): array
    {
        return [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ];
    }
}