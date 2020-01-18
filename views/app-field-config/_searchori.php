<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppFieldConfigSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-field-config-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_app_field_config') ?>

    <?= $form->field($model, 'classname') ?>

    <?= $form->field($model, 'fieldname') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'no_order') ?>

    <?php // echo $form->field($model, 'is_visible') ?>

    <?php // echo $form->field($model, 'is_required') ?>

    <?php // echo $form->field($model, 'is_unique') ?>

    <?php // echo $form->field($model, 'is_safe') ?>

    <?php // echo $form->field($model, 'type_field') ?>

    <?php // echo $form->field($model, 'max_field') ?>

    <?php // echo $form->field($model, 'default_value') ?>

    <?php // echo $form->field($model, 'pattern') ?>

    <?php // echo $form->field($model, 'image_extensions') ?>

    <?php // echo $form->field($model, 'image_max_size') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
