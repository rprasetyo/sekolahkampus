<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CpanelLeftmenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cpanel-leftmenu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_leftmenu') ?>

    <?= $form->field($model, 'id_parent_leftmenu') ?>

    <? //= $form->field($model, 'has_child') ?>

    <?= $form->field($model, 'menu_name') ?>

    <?= $form->field($model, 'menu_icon') ?>

    <?php echo $form->field($model, 'value_indo') ?>

    <?php echo $form->field($model, 'value_eng') ?>

    <?php echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'is_public') ?>

    <?php echo $form->field($model, 'auth') ?>

    <?php echo $form->field($model, 'mobile_display') ?>

    <?php echo $form->field($model, 'visible') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
