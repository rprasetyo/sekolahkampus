<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\common\helpers\DatabaseTableReflection;

/* @var $this yii\web\View */
/* @var $model app\models\AppFieldConfigSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
//CSS Ini digunakan untuk overide jarak antar form biar tidak terlalu jauh
?>
<style>
    .form-group {
        margin-bottom: 0px;
    }
</style>

<?php
$datalist = DatabaseTableReflection::getListTableName();
?>

<div class="app-field-config-search">
    <div class="box-body with-border">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'action' => ['index-varian'],
            'method' => 'get',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-sm-1',
                    'offset' => 'col-sm-offset-2',
                    'wrapper' => 'col-sm-10',
                ],
            ],
        ]); ?>

        <div class="box-header with-border">
            <h3 class="box-title">Cari Berdasarkan : </h3>
        </div>

        <!--    --><?php //$form->field($model, 'id_app_field_config') ?>

        <?php //= $form->field($model, 'classname') ?>
		

		<?php echo $form->field($model, 'classname')->dropDownList(
                $datalist, 
                ['prompt'=>'Silakan Pilih Nama Tabel...']);
		?>
		
		 <?php echo $form->field($model, 'varian_group') ?>

        <!--    --><?php //$form->field($model, 'fieldname') ?>

        <!--    --><?php //$form->field($model, 'label') ?>

        <!--    --><?php //$form->field($model, 'no_order') ?>

        <?php // echo $form->field($model, 'is_visible') ?>

        <?php // echo $form->field($model, 'is_required') ?>

        <?php // echo $form->field($model, 'is_unique') ?>

        <?php // echo $form->field($model, 'is_safe') ?>

        <?php // echo $form->field($model, 'type_field') ?>

        <?php // echo $form->field($model, 'max_field') ?>

        <?php // echo $form->field($model, 'default_value') ?>

        <?php // echo $form->field($model, 'pattern') ?>

        <?php // echo $form->field($model, 'image_extensions') ?>

        <?php // echo $form->field($model, 'image_max_size') ?>

        <div class="box-footer clearfix">
            <div class="form-group">
                <?= Html::submitButton('Tampilkan', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
