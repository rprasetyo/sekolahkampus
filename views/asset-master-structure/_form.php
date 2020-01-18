<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AssetMaster;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterStructure */
/* @var $form yii\widgets\ActiveForm */

$dataAssetMaster = ['' => 'Pilih'] + ArrayHelper::map(AssetMaster::find()->all(), 'id_asset_master', 'asset_name');
?>

<?php
//CSS Ini digunakan untuk menampilkan required field (field wajib isi)
?>
<style>
    div.required label.control-label:after {
        content: " *";
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

<div class="asset-master-structure-form box box-success">

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< ' . CommonActionLabelEnum::BACK, ['index'], ['class' => 'btn btn-warning']) ?>
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
                    'wrapper' => 'col-sm-9',
                ],
            ],
        ]); ?>

        <?= $form->field($model, 'id_asset_master_parent')->widget(Select2::classname(), [
            'data' => $dataAssetMaster,
            // 'options' => ['placeholder' => 'Pilih Kelurahan ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model, 'id_asset_master_child')->widget(Select2::classname(), [
            'data' => $dataAssetMaster,
            // 'options' => ['placeholder' => 'Pilih Kelurahan ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <div class="box-footer">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>