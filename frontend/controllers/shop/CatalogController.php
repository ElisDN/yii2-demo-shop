<?php

namespace frontend\controllers\shop;

use yii\web\Controller;

class CatalogController extends Controller
{
    public $layout = 'catalog';

    public function actionIndex()
    {
        return $this->render('index');
    }
}