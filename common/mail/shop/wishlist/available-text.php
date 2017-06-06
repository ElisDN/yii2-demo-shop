<?php

/* @var $this yii\web\View */
/* @var $user \shop\entities\User\User */
/* @var $product \shop\entities\Shop\Product\Product */

$link = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['shop/catalog/product', 'id' => $product->id]);
?>
Hello <?= $user->username ?>,

Product from your wishlist is available right now:

<?= $link ?>