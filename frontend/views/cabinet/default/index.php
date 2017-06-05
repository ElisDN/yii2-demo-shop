<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit Profile', ['cabinet/profile/edit'], ['class' => 'btn btn-primary']) ?>
    </p>

    <p>Hello!</p>

    <h2>Attach profile</h2>
    <?= yii\authclient\widgets\AuthChoice::widget([
        'baseAuthUrl' => ['cabinet/network/attach'],
    ]); ?>
</div>
