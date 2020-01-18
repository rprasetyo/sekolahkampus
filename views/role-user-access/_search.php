<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RoleUserAccessSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-user-access-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_role_user_access') ?>

    <?= $form->field($model, 'id_role_menu') ?>

    <?= $form->field($model, 'role_name') ?>

    <?= $form->field($model, 'user_read') ?>

    <?= $form->field($model, 'user_write') ?>

    <?php // echo $form->field($model, 'user_delete') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
