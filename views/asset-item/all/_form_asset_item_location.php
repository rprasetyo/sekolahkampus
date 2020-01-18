<?php

use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItemLocation */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
/*
$dataAssetMaster = ArrayHelper::map(AssetMaster::find()->asArray()->all(), 'id_asset_master', 'asset_name');
echo $form->field($model, 'id_asset_master')->dropDownList($dataAssetMaster,
    ['prompt' => '-Choose a Asset-']);
*/
?>


<?php //= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

<?php
/*
$dataAssetMaster = ArrayHelper::map(AssetMaster::find()->asArray()->all(), 'id_asset_master', 'asset_name');
echo $form->field($model, 'id_asset_master')->dropDownList($dataAssetMaster,
    ['prompt' => '-Choose a Asset-']);
*/
?>

<?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'batas_utara')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'batas_selatan')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'batas_timur')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'batas_barat')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'luas')->textInput(['maxlength' => true]) ?>

<!--        --><?php //$form->field($model, 'desa')->textInput(['maxlength' => true]) ?>

<!--        --><?php //$form->field($model, 'kecamatan')->textInput(['maxlength' => true]) ?>

<!--        --><?php //$form->field($model, 'kabupaten')->textInput(['maxlength' => true]) ?>

<!--        --><?php //$form->field($model, 'provinsi')->textInput(['maxlength' => true]) ?>
<?php
/*
$dataProvinsi = ArrayHelper::map(Propinsi::find()->asArray()->all(), 'id_propinsi', 'nama_propinsi');
echo $form->field($model, 'id_propinsi')->dropDownList($dataProvinsi,
    ['prompt' => '-Pilih Provinsi-']);
*/
?>


<?php /*
<?php $dataKabupaten = ArrayHelper::map(Kabupaten::find()->asArray()->all(), 'id_kabupaten', 'nama_kabupaten');
echo $form->field($model, 'id_kabupaten')->dropDownList($dataKabupaten,
    ['prompt' => '-Pilih Kabupaten-']); ?>

<?php $dataKecamatan = ArrayHelper::map(Kecamatan::find()->asArray()->all(), 'id_kecamatan', 'nama_kecamatan');
echo $form->field($model, 'id_kecamatan')->dropDownList($dataKecamatan,
    ['prompt' => '-Pilih Kecamatan-']); ?>

<?php $dataKelurahan = ArrayHelper::map(Kelurahan::find()->asArray()->all(), 'id_kelurahan', 'nama_kelurahan');
echo $form->field($model, 'id_kelurahan')->dropDownList($dataKelurahan,
    ['prompt' => '-Pilih Kelurahan-']); ?>
*/ ?>

<?= $form->field($model, 'keterangan1')->dropDownList(['ADA' => 'ADA', 'TIDAK' => 'TIDAK'],
    ['prompt' => '-Pilih-']) ?>

<?php // echo $form->field($model, 'kodepos')->textInput(['maxlength' => true]) ?>

<?php
/*
$dataProvinsi = ArrayHelper::map(Propinsi::find()->asArray()->all(), 'id_propinsi', 'nama_propinsi');
echo $form->field($model, 'id_propinsi')->dropDownList($dataProvinsi,
    [
        'class' => 'form-control select2',
        'prompt' => '-Pilih Provinsi-',
        'onchange' => '
            $.post( "' . Yii::$app->urlManager->createUrl('asset-item-location/lists?id=') . '"+$(this).val(), function( data ) {
            $( "select#assetitemlocation-id_kabupaten" ).html( data );
            });
    ']);
*/
?>
<?php $dataKabupaten = ArrayHelper::map(Kabupaten::find()->asArray()->all(), 'id_kabupaten', 'nama_kabupaten');
echo $form->field($model, 'id_kabupaten')->widget(Select2::classname(), [
    'data' => $dataKabupaten,
    'pluginOptions' => [
        'allowClear' => true
    ],
    'options' => [
        'prompt' => 'Pilih Kabupaten',
        'onchange' => '
            $.post( "' . Yii::$app->urlManager->createUrl('asset-item-location/kecamatan?id=') . '"+$(this).val(), function( data ) {
            $( "select#assetitemlocation-id_kecamatan" ).html( data );
            });

    ']
]);
?>

<?php $dataKecamatan = ArrayHelper::map(Kecamatan::find()->asArray()->all(), 'id_kecamatan', 'nama_kecamatan');
echo $form->field($model, 'id_kecamatan')->widget(Select2::classname(), [
    'data' => $dataKecamatan,
    'pluginOptions' => [
        'allowClear' => true
    ],
    'options' => [
        'prompt' => 'Pilih Kecamatan ...',
        'onchange' => '
            $.post( "' . Yii::$app->urlManager->createUrl('asset-item-location/kelurahan?id=') . '"+$(this).val(), function( data ) {
            $( "select#assetitemlocation-id_kelurahan" ).html( data );
            });

    ']
]);
?>

<?php $dataKelurahan = ArrayHelper::map(Kelurahan::find()->asArray()->all(), 'id_kelurahan', 'nama_kelurahan');
echo $form->field($model, 'id_kelurahan')->widget(Select2::classname(), [
    'data' => $dataKelurahan,
    'options' => ['placeholder' => 'Pilih Kelurahan ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>

<?php // echo $form->field($model, 'kodepos')->textInput(['maxlength' => true]) ?>
