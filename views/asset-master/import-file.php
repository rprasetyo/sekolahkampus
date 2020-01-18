<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

/* @var $modelImport app\models\AssetMaster */


$this->title = CommonActionLabelEnum::LIST_ALL . "" . AppVocabularySearch::getValueByKey('Import Data');
?>

<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/extensions/js/sweetalert2/dist/sweetalert2.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/extensions/js/sweetalert2/dist/core.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerCssFile(Yii::$app->request->baseUrl . '/extensions/js/sweetalert2/dist/sweetalert2.min.css'); ?>

<div class="box">
    <div class="box-body">
        <div class="callout callout-info">
            <p> <?php $this->title = CommonActionLabelEnum::PLEASE_CHOOSE . "" . AppVocabularySearch::getValueByKey(' Data file') ?>
                <b>File Asset (<?= date('F Y') ?>)</b>
            </p>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'import']]); ?>

        <?= FileInput::widget(['model' => $modelImport,
            'attribute' => 'fileImport',
            'pluginOptions' => [
                'allowedFileExtensions' => ['xls', 'xlsx', 'csv'],
                'showUpload' => true,
                'maxFileSize' => 10240,
            ],

        ]);
        ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$this->registerJs(
    '
		$( document ).ready(function() {
			$("#import").on("afterValidate", function(){
				swal({
						  title: "Please Wait",
						  text: "saving..",
						  type: "info",
						  allowOutsideClick: false,
						  showCancelButton: false, // There wont be any cancel button
						  showConfirmButton: false, // There wont be any confirm button
						  allowEscapeKey:false,
						  onOpen: function () {
							swal.showLoading();
						  }, 

						});
			});
		});
'); ?>
