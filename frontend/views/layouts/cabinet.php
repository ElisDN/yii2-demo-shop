<?php

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <div id="content" class="col-sm-9">
        <?= $content ?>
    </div>
    <aside id="column-right" class="col-sm-3 hidden-xs">
        <div class="list-group">
            <a href="/account/login" class="list-group-item">Login</a>
            <a href="/account/register" class="list-group-item">Register</a>
            <a href="/account/forgotten" class="list-group-item">Forgotten Password</a>
            <a href="/account/account" class="list-group-item">My Account</a>
            <a href="/account/wishlist" class="list-group-item">Wish List</a>
            <a href="/account/order" class="list-group-item">Order History</a>
            <a href="/account/newsletter" class="list-group-item">Newsletter</a>
        </div>
    </aside>
</div>

<?php $this->endContent() ?>
