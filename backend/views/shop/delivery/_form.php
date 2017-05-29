<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Shop\DeliveryMethodForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="method-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'cost')->textInput() ?>
            <?= $form->field($model, 'minWeight')->textInput() ?>
            <?= $form->field($model, 'maxWeight')->textInput() ?>
            <?= $form->field($model, 'sort')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
