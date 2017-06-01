<?php

namespace api\controllers;

use yii\rest\Controller;

class SiteController extends Controller
{
    public function actionIndex(): array
    {
        return [
            'version' => '1.0.0',
        ];
    }
}
