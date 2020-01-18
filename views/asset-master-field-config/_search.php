<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterFieldConfigSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-master-field-config-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_asset_master_field_config') ?>

    <?= $form->field($model, 'fieldname') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'is_visible') ?>

    <?= $form->field($model, 'is_required') ?>

    <?php // echo $form->field($model, 'type_field') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
