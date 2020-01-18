<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RoleUserAccess */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-user-access-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_role_menu')->textInput() ?>

    <?= $form->field($model, 'role_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_read')->textInput() ?>

    <?= $form->field($model, 'user_write')->textInput() ?>

    <?= $form->field($model, 'user_delete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
