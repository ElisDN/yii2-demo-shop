<?php

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Shop\DeliveryMethodForm */

$this->title = 'Create Delivery Method';
$this->params['breadcrumbs'][] = ['label' => 'DeliveryMethods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="method-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
