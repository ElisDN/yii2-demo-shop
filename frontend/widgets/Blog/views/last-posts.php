<?php

/** @var $posts shop\entities\Blog\Post\Post[] */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
?>

<div class="row">
    <?php foreach ($posts as $post): ?>
        <?php $url = Url::to(['/blog/post/post', 'id' =>$post->id]); ?>
        <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="product-thumb transition">
                <?php if ($post->photo): ?>
                    <div class="image">
                        <a href="<?= Html::encode($url) ?>">
                            <img src="<?= Html::encode($post->getThumbFileUrl('photo', 'widget_list')) ?>" alt="" class="img-responsive" />
                        </a>
                    </div>
                <?php endif; ?>
                <div>
                    <div class="caption">
                        <h4><a href="<?= Html::encode($url) ?>"><?= Html::encode($post->title) ?></a></h4>
                        <p><?= Html::encode(StringHelper::truncateWords(strip_tags($post->description), 20)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
