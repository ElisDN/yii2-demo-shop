<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $page shop\entities\Page */

$this->title = $page->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $page->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $page->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $page,
                'attributes' => [
                    'id',
                    'title',
                    'slug',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Content</div>
        <div class="box-body">
            <?= Yii::$app->formatter->asHtml($page->content, [
                'Attr.AllowedRel' => array('nofollow'),
                'HTML.SafeObject' => true,
                'Output.FlashCompat' => true,
                'HTML.SafeIframe' => true,
                'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $page,
                'attributes' => [
                    'meta.title',
                    'meta.description',
                    'meta.keywords',
                ],
            ]) ?>
        </div>
    </div>
</div>
