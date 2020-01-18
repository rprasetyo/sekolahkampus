<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Perusahaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perusahaan-form box box-primary">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'class' => 'form-horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-3',
                'wrapper' => 'col-sm-10',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>
    <div class="box-body table-responsive">
        <div class="col-md-12">

            <?php // $form->field($model, 'security_code')->textInput(['maxlength' => true]) ?>

            <?php // $form->field($model, 'qrcode_perusahaan')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nama_perusahaan')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email1')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email2')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone1')->textInput() ?>

            <?= $form->field($model, 'phone2')->textInput() ?>

            <?= $form->field($model, 'media_sosial1')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'media_sosial2')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'media_sosial3')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive'], ['prompt' => 'Select...']) ?>

        </div>
        <div class="box-footer">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
