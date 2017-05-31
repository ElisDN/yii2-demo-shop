<?php

/* @var $this yii\web\View */
/* @var $post shop\entities\Blog\Post\Post */

use yii\helpers\Html;

$this->title = $post->getSeoTitle();

$this->registerMetaTag(['name' =>'description', 'content' => $post->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $post->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $post->category->name, 'url' => ['category', 'slug' => $post->category->slug]];
$this->params['breadcrumbs'][] = $post->title;

$this->params['active_category'] = $post->category;

$tagLinks = [];
foreach ($post->tags as $tag) {
    $tagLinks[] = Html::a(Html::encode($tag->name), ['tag', 'slug' => $tag->slug]);
}
?>

<article>
    <h1><?= Html::encode($post->title) ?></h1>

    <p><span class="glyphicon glyphicon-calendar"></span> <?= Yii::$app->formatter->asDatetime($post->created_at); ?></p>

    <?php if ($post->photo): ?>
        <p><img src="<?= Html::encode($post->getThumbFileUrl('photo', 'origin')) ?>" alt="" class="img-responsive" /></p>
    <?php endif; ?>

    <p><?= Yii::$app->formatter->asNtext($post->content) ?></p>
</article>

<p>Tags: <?= implode(', ', $tagLinks) ?></p>


