<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem */

$this->title = CommonActionLabelEnum::UPDATE . ' ' . AppVocabularySearch::getValueByKey(' Asset Item');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL . ' ' . AppVocabularySearch::getValueByKey(' Asset Item'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::DETAIL . ' ' . AppVocabularySearch::getValueByKey(' Asset Item'), 'url' => ['view', 'id' => $model->id_asset_item]];
$this->params['breadcrumbs'][] = CommonActionLabelEnum::UPDATE;
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

<div class="asset-item-create box box-primary">
	<div class="box-body">
<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
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
		<?= $form->errorSummary($model); ?>
	
		<?= $this->render('all/_form_asset_item', [
			'model' => $model,
			'form' => $form,
		]) ?>
		
		<?= $this->render('all/_form_asset_item_location', [
			'model' => $modelLocation,
			'form' => $form,
		]) ?>
		
		<?= $this->render('all/_form_asset_item_received', [
			'model' => $modelReceived,
			'form' => $form,
		]) ?>

        <?php /*= $this->render('all/_form_asset_item_type', [
            'model' => $modelTypeAssetItem,
            'form' => $form,
        ]) */ ?>
		
	<div class="box-footer">
		<div class="form-group">
			<?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
		</div>
	</div>
		
	<?php ActiveForm::end(); ?>
	</div>
</div>
