<?php

namespace frontend\controllers;

use shop\readModels\PageReadRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PagesController implements the CRUD actions for Page model.
 */
class PageController extends Controller
{
    private $pages;

    public function __construct($id, $module, PageReadRepository $pages, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->pages = $pages;
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     * @internal param string $slug
     */
    public function actionView($id)
    {
        if (!$page = $this->pages->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('view', [
            'page' => $page,
        ]);
    }
}
