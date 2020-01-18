<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\AssetItem_Generic;
use app\models\AppFieldConfigSearch;
use app\common\labeling\CommonActionLabelEnum;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem_Generic */
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

<div class="type-asset1-form box box-success">

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< '.CommonActionLabelEnum::BACK, ['list'], ['class' => 'btn btn-warning']) ?>
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
                    'wrapper' => 'col-sm-8',
                ],
            ],
        ]); ?>

        <?php
        $tableName = AssetItem_Generic::tableName(); //Ini yang diganti (Nama tabel dari modelnya)
        $listElements = AppFieldConfigSearch::getListFormElement($tableName, $form, $model);

		/*
        //Custom Elements (Untuk elemen tertentu yang ingin diganti)
        $elemenStatus = $form->field($model, 'is_active',
            ['wrapperOptions' => ['style' => 'display:inline-block']])
            ->inline(true)
            ->radioList(['1' => CommonActionLabelEnum::ACTIVE, '0' => CommonActionLabelEnum::IN_ACTIVE]);
        $listElements = AppFieldConfigSearch::replaceFormElement($listElements, "is_active", $elemenStatus);
		*/

        //Tampilkan secara Dinamis
        foreach($listElements as $formdis){
            echo $formdis;
        }
        ?>

        <div class="box-footer">
            <div class="form-group">
                <?= Html::submitButton(CommonActionLabelEnum::SAVE, ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
