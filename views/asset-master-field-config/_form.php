<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterFieldConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
//CSS Ini digunakan untuk menampilkan required field (field wajib isi)
?>
<style>
    div.required label.control-label:after {
        content: ' *';
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

<div class='asset-master-field-config-form box box-success'>
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
                    'wrapper' => 'col-sm-8',
                ],
            ],
        ]); ?>

        <?= $form->field($model, 'fieldname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

        <?php $dataVisible = ['1' => 'True', '0' => 'False'];
        echo $form->field($model, 'is_visible')->dropDownList($dataVisible,
            ['prompt' => '-Choose-']); ?>

        <?php $dataRequired = ['1' => 'True', '0' => 'False'];
        echo $form->field($model, 'is_required')->dropDownList($dataRequired,
            ['prompt' => '-Choose-']); ?>

        <?= $form->field($model, 'type_field')->textInput() ?>

        <div class="box-footer">
            <div class='form-group'>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
