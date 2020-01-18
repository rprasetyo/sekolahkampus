<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CpanelLeftmenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cpanel-leftmenu-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'id_leftmenu')->textInput() ?>

        <?= $form->field($model, 'id_parent_leftmenu')->textInput() ?>

        <?= $form->field($model, 'has_child')->textInput() ?>

        <?= $form->field($model, 'menu_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'menu_icon')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'value_indo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'value_eng')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'is_public')->textInput() ?>

        <?= $form->field($model, 'auth')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'mobile_display')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'visible')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
