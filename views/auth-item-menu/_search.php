<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItemMenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_auth_item_menu') ?>

    <?= $form->field($model, 'menu_utama') ?>

    <?= $form->field($model, 'child_menu') ?>

    <?= $form->field($model, 'role') ?>

    <?= $form->field($model, 'path') ?>

    <?php // echo $form->field($model, 'is_enable') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
