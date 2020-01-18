<?php

use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use app\models\TypeAssetItem1;
use app\models\TypeAssetItem2;
use app\models\AssetItemLocation;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItemSearch */
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
<div class="asset-item-search">
    <div class="box-body">
        <?php
        $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'action' => ['list-search'],
            'method' => 'get',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'offset' => 'col-sm-offset-2',
                    'wrapper' => 'col-sm-8',
                ],
            ],
        ]);
        ?>

        <?php $dataAssetType1 = ArrayHelper::map(TypeAssetItem1::find()->asArray()->all(), 'id_type_asset_item', 'type_asset_item'); ?>
        <?= $form->field($model, 'id_type_asset_item1')->dropDownList($dataAssetType1,
            ['prompt' => '--Semua--']); ?>

        <?php $dataAssetType2 = ArrayHelper::map(TypeAssetItem2::find()->asArray()->all(), 'id_type_asset_item', 'type_asset_item'); ?>
        <?= $form->field($model, 'id_type_asset_item2')->dropDownList($dataAssetType2,
            ['prompt' => '--Semua--']); ?>

        <?php //= $form->field($model, 'id_asset_item') ?>

        <?php //= $form->field($model, 'id_asset_master') ?>

        <?= $form->field($model, 'number1') ?>

<!--        --><?php //$dataAssetItemLocation = ArrayHelper::map(AssetItemLocation::find()->asArray()->all(), 'id_asset_item_location', 'keterangan1'); ?>
        <?= $form->field($model, 'bukti_kepemilikan')->dropDownList(['ADA'=>'ADA', 'TIDAK'=>'TIDAK'],
            ['prompt' => '--Semua--'])->label('Bukti Kepemilikan'); ?>

        <?php //= $form->field($model, 'number2') ?>

        <?php //= $form->field($model, 'number3') ?>

        <?php // echo $form->field($model, 'picture1') ?>

        <?php // echo $form->field($model, 'picture2') ?>

        <?php // echo $form->field($model, 'picture3') ?>

        <?php // echo $form->field($model, 'id_asset_received') ?>

        <?php // echo $form->field($model, 'id_asset_item_location') ?>
        <?php // echo $form->field($model, 'id_asset_item_location') ?>
        <?php $dataKabupaten = ArrayHelper::map(Kabupaten::find()->asArray()->all(), 'id_kabupaten', 'nama_kabupaten');
        echo $form->field($model, 'id_kabupaten')->widget(Select2::classname(), [
            'data' => $dataKabupaten,
            'pluginOptions' => [
                'allowClear' => true
            ],
            'options' => [
                'prompt' => 'Pilih Kabupaten',
                'onchange' => '
            $.post( "' . Yii::$app->urlManager->createUrl('asset-item/kecamatan?id=') . '"+$(this).val(), function( data ) {
            $( "select#assetitemsearch-id_kecamatan" ).html( data );
            });

    ']
        ])->label("Kabupaten");
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
            $.post( "' . Yii::$app->urlManager->createUrl('asset-item/kelurahan?id=') . '"+$(this).val(), function( data ) {
            $( "select#assetitemsearch-id_kelurahan" ).html( data );
            });

    ']
        ])->label("Kecamatan");
        ?>

        <?php $dataKelurahan = ArrayHelper::map(Kelurahan::find()->asArray()->all(), 'id_kelurahan', 'nama_kelurahan');
        echo $form->field($model, 'id_kelurahan')->widget(Select2::classname(), [
            'data' => $dataKelurahan,
            'options' => ['placeholder' => 'Pilih Kelurahan ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label("Kelurahan");
        ?>

    <div class="box-footer clearfix">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>

