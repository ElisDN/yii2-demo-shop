<?php

use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Blog\Post\PostForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Common</div>
                <div class="box-body">
                    <?= $form->field($model, 'categoryId')->dropDownList($model->categoriesList(), ['prompt' => '']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Tags</div>
                <div class="box-body">
                    <?= $form->field($model->tags, 'existing')->checkboxList($model->tags->tagsList()) ?>
                    <?= $form->field($model->tags, 'textNew')->textInput() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
            <?= $form->field($model, 'content')->widget(CKEditor::className()) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Photo</div>
        <div class="box-body">
            <?= $form->field($model, 'photo')->label(false)->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                ]
            ]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model->meta, 'title')->textInput() ?>
            <?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>
            <?= $form->field($model->meta, 'keywords')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
