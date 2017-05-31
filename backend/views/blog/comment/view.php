<?php

use kartik\file\FileInput;
use shop\entities\Blog\Post\Modification;
use shop\entities\Blog\Post\Value;
use shop\helpers\PriceHelper;
use shop\helpers\PostHelper;
use shop\helpers\WeightHelper;
use yii\bootstrap\ActiveForm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $post shop\entities\Blog\Post\Post */
/* @var $comment shop\entities\Blog\Post\Comment */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $post->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'post_id' => $post->id, 'id' => $comment->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($comment->isActive()): ?>
            <?= Html::a('Delete', ['delete', 'post_id' => $post->id, 'id' => $comment->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php else: ?>
            <?= Html::a('Restore', ['activate', 'post_id' => $post->id, 'id' => $comment->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Are you sure you want to activate this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $comment,
                'attributes' => [
                    'id',
                    'created_at:boolean',
                    'active:boolean',
                    'user_id',
                    'parent_id',
                    [
                        'attribute' => 'post_id',
                        'value' => $post->title,
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <?= Yii::$app->formatter->asNtext($comment->text) ?>
        </div>
    </div>

</div>
