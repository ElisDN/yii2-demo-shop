<?php

/* @var $this yii\web\View */
/* @var $model shop\entities\Blog\Post\Post */

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to(['post', 'id' =>$model->id]);
?>

<div class="blog-posts-item">
    <?php if ($model->photo): ?>
        <div>
            <a href="<?= Html::encode($url) ?>">
                <img src="<?= Html::encode($model->getThumbFileUrl('photo', 'blog_list')) ?>" alt="" class="img-responsive" />
            </a>
        </div>
    <?php endif; ?>
    <div class="h2"><a href="<?= Html::encode($url) ?>"><?= Html::encode($model->title) ?></a></div>
    <p><?= Yii::$app->formatter->asNtext($model->description) ?></p>
</div>


