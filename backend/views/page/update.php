<?php

/* @var $this yii\web\View */
/* @var $page shop\entities\Page */
/* @var $model shop\forms\manage\PageForm */

$this->title = 'Update Page: ' . $page->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $page->title, 'url' => ['view', 'id' => $page->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
