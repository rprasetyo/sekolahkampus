<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_asset_master')->textInput() ?>

    <?= $form->field($model, 'number1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'picture1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'picture2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'picture3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_asset_received')->textInput() ?>

    <?= $form->field($model, 'id_asset_item_location')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
