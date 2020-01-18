<?php

use app\models\AssetMaster;
use app\models\MstStatusReceived;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetReceived */
/* @var $form yii\widgets\ActiveForm */
?>

        <?php 
		/*
		$dataAssetMaster = ArrayHelper::map(AssetMaster::find()->asArray()->all(), 'id_asset_master', 'asset_name');
        echo $form->field($model, 'id_asset_master')->dropDownList($dataAssetMaster,
            ['prompt' => '-Choose a Asset Master-']); 
		*/	
		?>

		<?php /*
        <?= $form->field($model, 'number1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'number2')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'number3')->textInput(['maxlength' => true]) ?>
		*/ 
		?>
		
		 <?= $form->field($model, 'notes1')->textInput(['maxlength' => true]) ?>

        <?php 
		/*
		echo $form->field($model, 'received_date')->widget(
            \dosamigos\datepicker\DatePicker::className(), [
            // inline too, not bad
            'inline' => false,
            // modify template for custom rendering
            'template' => '{addon}{input}',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-dd',
            ]
        ]); 
		*/
		?>

        <?= $form->field($model, 'received_year')->textInput() ?>

        <?= $form->field($model, 'price_received')->textInput() ?>

        <?php //echo $form->field($model, 'quantity')->textInput() ?>

        <?php $dataStatusReceived = ArrayHelper::map(MstStatusReceived::find()->asArray()->all(), 'id_status_received', 'status_received');
        echo $form->field($model, 'id_status_received')->dropDownList($dataStatusReceived,
            ['prompt' => '-Pilih Kondisi Barang-']); ?>

