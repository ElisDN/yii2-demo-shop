<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $method shop\entities\Shop\DeliveryMethod */

$this->title = $method->name;
$this->params['breadcrumbs'][] = ['label' => 'DeliveryMethods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $method->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $method->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $method,
                'attributes' => [
                    'id',
                    'name',
                    'cost',
                    'min_weight',
                    'max_weight',
                ],
            ]) ?>
        </div>
    </div>
</div>
