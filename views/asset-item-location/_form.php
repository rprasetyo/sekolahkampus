<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\AssetMaster;
use app\models\Kelurahan;
use app\models\Kecamatan;
use app\models\Kabupaten;
use app\models\Propinsi;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItemLocation */
/* @var $form yii\widgets\ActiveForm */
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

<div class="asset-item-location-form box box-success">

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
                    'wrapper' => 'col-sm-9',
                ],
            ],
        ]); ?>

        <?php $dataAssetMaster = ArrayHelper::map(AssetMaster::find()->asArray()->all(), 'id_asset_master', 'asset_name');
        echo $form->field($model, 'id_asset_master')->dropDownList($dataAssetMaster,
            ['prompt' => '-Choose a Asset-']); ?>

        <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

<!--        --><?php //$form->field($model, 'desa')->textInput(['maxlength' => true]) ?>

<!--        --><?php //$form->field($model, 'kecamatan')->textInput(['maxlength' => true]) ?>

<!--        --><?php //$form->field($model, 'kabupaten')->textInput(['maxlength' => true]) ?>

<!--        --><?php //$form->field($model, 'provinsi')->textInput(['maxlength' => true]) ?>

        <?php $dataKelurahan = ArrayHelper::map(Kelurahan::find()->asArray()->all(), 'id_kelurahan', 'nama_kelurahan');
        echo $form->field($model, 'id_kelurahan')->dropDownList($dataKelurahan,
            ['prompt' => '-Pilih Kelurahan-']); ?>

        <?php $dataKecamatan = ArrayHelper::map(Kecamatan::find()->asArray()->all(), 'id_kecamatan', 'nama_kecamatan');
        echo $form->field($model, 'id_kecamatan')->dropDownList($dataKecamatan,
            ['prompt' => '-Pilih Kecamatan-']); ?>

        <?php $dataKabupaten = ArrayHelper::map(Kabupaten::find()->asArray()->all(), 'id_kabupaten', 'nama_kabupaten');
        echo $form->field($model, 'id_kabupaten')->dropDownList($dataKabupaten,
            ['prompt' => '-Pilih Kabupaten-']); ?>

        <?php $dataProvinsi = ArrayHelper::map(Propinsi::find()->asArray()->all(), 'id_propinsi', 'nama_propinsi');
        echo $form->field($model, 'id_propinsi')->dropDownList($dataProvinsi,
            ['prompt' => '-Pilih Provinsi-']); ?>

        <?= $form->field($model, 'kodepos')->textInput(['maxlength' => true]) ?>

        <div class="box-footer">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
