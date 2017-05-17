<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Hello!</p>

    <h2>Attach profile</h2>
    <?= yii\authclient\widgets\AuthChoice::widget([
        'baseAuthUrl' => ['cabinet/network/attach'],
    ]); ?>
</div>
