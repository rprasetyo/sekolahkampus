<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppFieldConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
//CSS Ini digunakan untuk menampilkan required field (field wajib isi)
?>
<style>
    div.required label.control-label:after {
        content: " *";
        color: red;
    }
</style>

<?php
//CSS Ini digunakan untuk overide jarak antar form biar tidak terlalu jauh
?>
<style>
    .form-group {
        margin-bottom: 0px;
    }
</style>

<div class="app-field-config-form box box-success">

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< Back', ['index'], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>

    <div class="box-header with-border">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            //'action' => ['index1'],
            //'method' => 'get',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'offset' => 'col-sm-offset-2',
                    'wrapper' => 'col-sm-9',
                ],
            ],
        ]); ?>

        <?= $form->field($model, 'classname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'fieldname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'no_order')->textInput() ?>

        <?= $form->field($model, 'is_visible',
            ['wrapperOptions' => ['style' => 'display:inline-block']])
            ->inline(true)
            ->radioList(['1' => 'True', '0' => 'False']) ?>

        <?= $form->field($model, 'is_required',
            ['wrapperOptions' => ['style' => 'display:inline-block']])
            ->inline(true)
            ->radioList(['1' => 'True', '0' => 'False']) ?>

        <?= $form->field($model, 'is_unique',
            ['wrapperOptions' => ['style' => 'display:inline-block']])
            ->inline(true)
            ->radioList(['1' => 'Ya', '0' => 'Tidak']) ?>

        <?= $form->field($model, 'is_safe',
            ['wrapperOptions' => ['style' => 'display:inline-block']])
            ->inline(true)
            ->radioList(['1' => 'Ya', '0' => 'Tidak']) ?>

        <?= $form->field($model, 'type_field')->textInput() ?>

        <?= $form->field($model, 'max_field')->textInput() ?>

        <?= $form->field($model, 'default_value')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pattern')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'image_extensions')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'image_max_size')->textInput(['maxlength' => true]) ?>

        <div class="box-footer">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
