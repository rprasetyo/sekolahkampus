<?php

use app\models\AppVocabularySearch;
use app\models\AssetMaster;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\common\labeling\CommonActionLabelEnum;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem */
/* @var $form yii\widgets\ActiveForm */

$this->title = CommonActionLabelEnum::LIST_ALL ."" . AppVocabularySearch::getValueByKey('Unggah Gambar Asset');
$this->params['breadcrumbs'][] = ['label' => 'Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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

<div class="content-form box box-success">
    <div class="box-header with-border">
        <p>
            <?= Html::a(CommonActionLabelEnum::BACK, ['index'], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>

    <div class="box-header with-border">
        <?php //$form = ActiveForm::begin(); ?>
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

        <div class="box-header with-border">
            <?php $dataListAssetMaster = ArrayHelper::map(AssetMaster::find()->asArray()->all(), 'id_asset_master', 'asset_name');
            echo $form->field($model, 'id_asset_master')->dropDownList($dataListAssetMaster,
                ['prompt' => '-Pilih Kode Barang-',
                    'label' => 'Type Of Supplier',
                    'disabled' => 'disabled']);
            ?>
            <?= $form->field($model, 'number2')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
            <?= $form->field($model, 'number1')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
        </div>

        <?php
        for ($i = 1; $i <= 5; $i++) {
            ?>
            <div class="box-header with-border">

                <div class="form-group row">

                    <?php
                    $fieldname = "picture" . $i;
                    $captionfield = "caption_picture" . $i;
                    if ($model->$fieldname != "") {
                        ?>
                        <label class="control-label col-sm-2" for="assetitem-picture4">Picture
                            Eksisting<?= $i ?></label>
                        <div class="col-sm-6">
                            <?php
                            if ($model->$fieldname != "") {
                                $label = "Re-Upload Gambar";
                                $res = '<img src="' . '../..' . '/web/images/asset_item/' . $model->$fieldname . '" class="img-responsive">';
                            } else {
                                $res = '<small class="label bg-orange">Gambar tidak ada</small><Br>';
                                $label = "Upload Gambar";
                            }
                            $res .= '<br>';

                            if ($model->$captionfield != "") {
                                $cap = $model->$captionfield;
                            } else {
                                $cap = "-- No Caption--";
                            }
                            echo '<div class="box-footer box-comments" style="">' . $cap . '</div>';
                            echo $res;
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <?php
                echo $form->field($model, 'picture' . $i)->widget(\kartik\file\FileInput::className(), [
                    'pluginOptions' => [
                        'showUpload' => false,
                        'browseLabel' => 'Select Photo',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',

                    ],
                ]);
                ?>
                <?= $form->field($model, 'caption_picture' . $i)->textInput() ?>
            </div>
            <?php
        }
        ?>


        <div class="box-footer">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
