<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $page \shop\entities\Page */

$this->title = $page->getSeoTitle();

$this->registerMetaTag(['name' => 'description', 'content' => $page->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $page->meta->keywords]);

foreach ($page->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->title, 'url' => ['view', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = $page->title;
?>
<article class="page-view">

    <h1><?= Html::encode($page->title) ?></h1>

    <?= Yii::$app->formatter->asNtext($page->content) ?>

</article>
