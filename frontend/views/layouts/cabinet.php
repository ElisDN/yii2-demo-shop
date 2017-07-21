<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <div id="content" class="col-sm-9">
        <?= $content ?>
    </div>
    <aside id="column-right" class="col-sm-3 hidden-xs">
        <div class="list-group">
            <a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>" class="list-group-item">Login</a>
            <a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>" class="list-group-item">Signup</a>
            <a href="<?= Html::encode(Url::to(['/auth/reset/request'])) ?>" class="list-group-item">Forgotten Password</a>
            <a href="<?= Html::encode(Url::to(['/cabinet/wishlist/index'])) ?>" class="list-group-item">Wish List</a>
            <a href="<?= Html::encode(Url::to(['/cabinet/order'])) ?>" class="list-group-item">Order History</a>
            <a href="<?= Html::encode(Url::to(['/cabinet/newsletter'])) //todo what is it? ?>" class="list-group-item">Newsletter</a>
        </div>
    </aside>
</div>

<?php $this->endContent() ?>
