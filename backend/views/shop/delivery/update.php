<?php

/* @var $this yii\web\View */
/* @var $method shop\entities\Shop\DeliveryMethod */
/* @var $model shop\forms\manage\Shop\DeliveryMethodForm */

$this->title = 'Update Delivery Method: ' . $method->name;
$this->params['breadcrumbs'][] = ['label' => 'DeliveryMethods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $method->name, 'url' => ['view', 'id' => $method->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="method-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
