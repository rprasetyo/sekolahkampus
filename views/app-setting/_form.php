<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppSetting */
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

<?php
$this->registerJs(
    "
         $('#image_file').on('change', function() {
                var coba = this.files[0].name
                var name = $('#setting_name').val()
                var split = coba.split('.')[1];
//                alert(name+'.'+split);
				$('#value').val(name+'.'+split)
		});
		"
);

$this->registerJs(
    "
		document.querySelectorAll(\"#radio input[type='radio']\").forEach(function(element){
            element.addEventListener('change',function(){
                if(this.value == '0' ) {
//                    document.querySelector('#image_file').parentElement.style.display = 'none';
                    $('#image_file').attr('disabled', true);
//                    $('#value').attr('visibled', false);
                } else {
                    $('#image_file').attr('disabled', false);
//                    $('#value').attr('visibled', true);
                }
            });
        });
		"
);
?>

<div class="app-setting-form box box-success">

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

        <?= $form->field($model, 'setting_name')->textInput(['maxlength' => true, 'id' => 'setting_name', 'readonly' => 'true']) ?>

        <?php //echo $form->field($model, 'is_image')->radioList(['1' => 'True', '0' => 'False'], ['id' => 'radio']) ?>

        <?php 
		if($model->is_image ==1){
			echo $form->field($model, 'image_file')->fileInput(['maxlength' => true, 'id' => 'image_file']); 
		}else{
			echo $form->field($model, 'value')->textInput(['maxlength' => true, 'id' => 'value']);
		}
		?>

        <?php //= $form->field($model, 'value')->textInput(['maxlength' => true, 'id' => 'value']) ?>

		<?php echo $form->errorSummary($model); ?>

        <div class="box-footer">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
