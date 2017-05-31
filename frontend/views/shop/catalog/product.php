<?php

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */
/* @var $cartForm shop\forms\Shop\AddToCartForm */
/* @var $reviewForm shop\forms\Shop\ReviewForm */

use frontend\assets\MagnificPopupAsset;
use shop\helpers\PriceHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $product->name;

$this->registerMetaTag(['name' =>'description', 'content' => $product->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $product->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
foreach ($product->category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ['category', 'id' => $product->category->id]];
$this->params['breadcrumbs'][] = $product->name;

$this->params['active_category'] = $product->category;

MagnificPopupAsset::register($this);
?>

<div class="row" xmlns:fb="http://www.w3.org/1999/xhtml">
    <div class="col-sm-8">
        <ul class="thumbnails">
            <?php foreach ($product->photos as $i => $photo): ?>
                <?php if ($i == 0): ?>
                    <li>
                        <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>">
                            <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>" alt="<?= Html::encode($product->name) ?>" />
                        </a>
                    </li>
                <?php else: ?>
                    <li class="image-additional">
                        <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>" title="HP LP3065">
                            <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>" alt="" />
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
            <li><a href="#tab-specification" data-toggle="tab">Specification</a></li>
            <li><a href="#tab-review" data-toggle="tab">Reviews (0)</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-description"><p>
                <?= Yii::$app->formatter->asHtml($product->description, [
                    'Attr.AllowedRel' => array('nofollow'),
                    'HTML.SafeObject' => true,
                    'Output.FlashCompat' => true,
                    'HTML.SafeIframe' => true,
                    'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                ]) ?>
            </div>
            <div class="tab-pane" id="tab-specification">
                <table class="table table-bordered">
                    <tbody>
                    <?php foreach ($product->values as $value): ?>
                        <?php if (!empty($value->value)): ?>
                            <tr>
                                <th><?= Html::encode($value->characteristic->name) ?></th>
                                <td><?= Html::encode($value->value) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab-review">
                <div id="review"></div>
                <h2>Write a review</h2>

                <?php if (Yii::$app->user->isGuest): ?>

                    <div class="panel-panel-info">
                        <div class="panel-body">
                            Please <?= Html::a('Log In', ['/auth/auth/login']) ?> for writing a review.
                        </div>
                    </div>

                <?php else: ?>

                    <?php $form = ActiveForm::begin(['id' => 'form-review']) ?>

                    <?= $form->field($reviewForm, 'vote')->dropDownList($reviewForm->votesList(), ['prompt' => '--- Select ---']) ?>
                    <?= $form->field($reviewForm, 'text')->textarea(['rows' => 5]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                    </div>

                    <?php ActiveForm::end() ?>

                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <p class="btn-group">
            <button type="button" data-toggle="tooltip" class="btn btn-default" title="Add to Wish List" href="<?= Url::to(['/cabinet/wishlist/add', 'id' => $product->id]) ?>" data-method="post"><i class="fa fa-heart"></i></button>
            <button type="button" data-toggle="tooltip" class="btn btn-default" title="Compare this Product" onclick="compare.add('47');"><i class="fa fa-exchange"></i></button>
        </p>
        <h1><?= Html::encode($product->name) ?></h1>
        <ul class="list-unstyled">
            <li>Brand: <a href="<?= Html::encode(Url::to(['brand', 'id' => $product->brand->id])) ?>"><?= Html::encode($product->brand->name) ?></a></li>
            <li>
                Tags:
                <?php foreach ($product->tags as $tag): ?>
                    <a href="<?= Html::encode(Url::to(['tag', 'id' => $tag->id])) ?>"><?= Html::encode($tag->name) ?></a>
                <?php endforeach; ?>
            </li>
            <li>Product Code: <?= Html::encode($product->code) ?></li>
        </ul>
        <ul class="list-unstyled">
            <li>
                <h2><?= PriceHelper::format($product->price_new) ?></h2>
            </li>
        </ul>
        <div id="product">

            <?php if ($product->isAvailable()): ?>

                <hr>
                <h3>Available Options</h3>

                <?php $form = ActiveForm::begin([
                    'action' => ['/shop/cart/add', 'id' => $product->id],
                ]) ?>

                <?php if ($modifications = $cartForm->modificationsList()): ?>
                    <?= $form->field($cartForm, 'modification')->dropDownList($modifications, ['prompt' => '--- Select ---']) ?>
                <?php endif; ?>

                <?= $form->field($cartForm, 'quantity')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Add to Cart', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                </div>

                <?php ActiveForm::end() ?>

            <?php else: ?>

                <div class="alert alert-danger">
                    The product is not available for purchasing right now.<br />Add it to your wishlist.
                </div>

            <?php endif; ?>

        </div>
        <div class="rating">
            <p>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a> / <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a></p>
            <hr>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style" data-url="/index.php?route=product/product&amp;product_id=47"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
            <!-- AddThis Button END -->
        </div>
    </div>
</div>

<?php $js = <<<EOD
$('.thumbnails').magnificPopup({
    type: 'image',
    delegate: 'a',
    gallery: {
        enabled:true
    }
});
EOD;
$this->registerJs($js); ?>



