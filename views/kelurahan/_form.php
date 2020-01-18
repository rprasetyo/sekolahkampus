<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Kecamatan;
use app\models\Kelurahan;
use yii\helpers\ArrayHelper;
use app\models\AppFieldConfigSearch;
use app\common\labeling\CommonActionLabelEnum;

/* @var $this yii\web\View */
/* @var $model app\models\Kelurahan */
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

<div class="kelurahan-form box box-success">

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< '.CommonActionLabelEnum::BACK, ['index'], ['class' => 'btn btn-warning']) ?>
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

		<?php
			$tableName = Kelurahan::tableName(); //Ini yang diganti (Nama tabel dari modelnya)
			$listElements = AppFieldConfigSearch::getListFormElement($tableName, $form, $model);
			
			//Custom Elements (Untuk elemen tertentu yang ingin diganti)
			$dataKecamatan = ArrayHelper::map(Kecamatan::find()->asArray()->all(), 'id_kecamatan', 'nama_kecamatan');
			$elemenKecamatan = $form->field($model, 'id_kecamatan')->dropDownList($dataKecamatan,
				['prompt' => '-Pilih Kecamatan-']);
			$listElements = AppFieldConfigSearch::replaceFormElement($listElements, "id_kecamatan", $elemenKecamatan);
			
			//Tampilkan secara Dinamis
			foreach($listElements as $formdis){
				echo $formdis;
			}
		?>

		<?php /*
        <?= $form->field($model, 'nama_kelurahan')->textInput(['maxlength' => true]) ?>

        <?php $dataKecamatan = ArrayHelper::map(Kecamatan::find()->asArray()->all(), 'id_kecamatan', 'nama_kecamatan');
        echo $form->field($model, 'id_kecamatan')->dropDownList($dataKecamatan,
            ['prompt' => '-Pilih Kecamatan-']); ?>

        <?= $form->field($model, 'kodepos')->textInput() ?>
		*/ ?>
		
		
        <div class="box-footer">
            <div class="form-group">
                <?= Html::submitButton(CommonActionLabelEnum::SAVE, ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
