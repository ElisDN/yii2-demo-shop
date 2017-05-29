<?php

/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */
/* @var $model \shop\forms\Shop\Order\OrderForm */

use shop\helpers\PriceHelper;
use shop\helpers\WeightHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Checkout';
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Shopping Cart', 'url' => ['/shop/cart/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="text-left">Product Name</td>
                <td class="text-left">Model</td>
                <td class="text-left">Quantity</td>
                <td class="text-right">Unit Price</td>
                <td class="text-right">Total</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart->getItems() as $item): ?>
                <?php
                $product = $item->getProduct();
                $modification = $item->getModification();
                $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                ?>
                <tr>
                    <td class="text-left">
                        <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                    </td>
                    <td class="text-left">
                        <?php if ($modification): ?>
                            <?= Html::encode($modification->name) ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-left">
                        <?= $item->getQuantity() ?>
                    </td>
                    <td class="text-right"><?= PriceHelper::format($item->getPrice()) ?></td>
                    <td class="text-right"><?= PriceHelper::format($item->getCost()) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <br />

    <?php $cost = $cart->getCost() ?>
    <table class="table table-bordered">
        <tr>
            <td class="text-right"><strong>Sub-Total:</strong></td>
            <td class="text-right"><?= PriceHelper::format($cost->getOrigin()) ?></td>
        </tr>
        <tr>
            <td class="text-right"><strong>Total:</strong></td>
            <td class="text-right"><?= PriceHelper::format($cost->getTotal()) ?></td>
        </tr>
        <tr>
            <td class="text-right"><strong>Weight:</strong></td>
            <td class="text-right"><?= WeightHelper::format($cart->getWeight()) ?></td>
        </tr>
    </table>

    <?php $form = ActiveForm::begin() ?>

    <div class="panel panel-default">
        <div class="panel-heading">Customer</div>
        <div class="panel-body">
            <?= $form->field($model->customer, 'phone')->textInput() ?>
            <?= $form->field($model->customer, 'name')->textInput() ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Delivery</div>
        <div class="panel-body">
            <?= $form->field($model->delivery, 'method')->dropDownList($model->delivery->deliveryMethodsList(), ['prompt' => '--- Select ---']) ?>
            <?= $form->field($model->delivery, 'index')->textInput() ?>
            <?= $form->field($model->delivery, 'address')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Note</div>
        <div class="panel-body">
            <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Checkout', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
    
