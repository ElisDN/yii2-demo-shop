<?php

use shop\entities\Blog\Post\Post;
use shop\helpers\PriceHelper;
use shop\helpers\PostHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Blog\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'value' => function (Post $model) {
                            return $model->photo ? Html::img($model->getThumbFileUrl('photo', 'admin')) : null;
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 100px'],
                    ],
                    'id',
                    'created_at:datetime',
                    [
                        'attribute' => 'title',
                        'value' => function (Post $model) {
                            return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'category_id',
                        'filter' => $searchModel->categoriesList(),
                        'value' => 'category.name',
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => $searchModel->statusList(),
                        'value' => function (Post $model) {
                            return PostHelper::statusLabel($model->status);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
