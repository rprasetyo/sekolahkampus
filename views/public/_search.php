<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\JenisSekolah;
use app\models\Kabupaten;
use app\models\Propinsi;
use app\models\StatusMilik;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Sekolah;

/* @var $this yii\web\View */
/* @var $model app\models\SekolahSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box-body" style="">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="col-sm-3 col-md-3">
        <?php
        $data = Sekolah::find()
            ->select(['nama_sekolah as value', 'nama_sekolah as label'])
            ->asArray()
            ->all();
        echo $form->field($model, 'nama_sekolah')->label(false)->widget(\yii\jui\AutoComplete::className(), ['clientOptions' => ['source' => $data], 'options' =>
            [
                'placeholder' => 'Enter Sekolah Kampus',
                'class' => 'form-control autocomplete-input-bg-arrow ',
            ],])
        ;
        ?>
    </div>
    <div class="col-md-2 col-sm-3">
        <?php $dataKabupaten = ArrayHelper::map(JenisSekolah::find()->asArray()->all(), 'id_jenis_sekolah', 'jenis_sekolah');
        echo $form->field($model, 'id_jenis_sekolah')->label(false)->widget(Select2::classname(), [
            'data' => $dataKabupaten,
            'pluginOptions' => [
                'allowClear' => true
            ],
            'options' => [
                'prompt' => 'Pilih Jenis Sekolah',

            ]
        ]);
        ?>
    </div>
    <div class="col-sm-3 col-md-2">
        <?php $dataKabupaten = ArrayHelper::map(StatusMilik::find()->asArray()->all(), 'id_status_milik', 'status_milik');
        echo $form->field($model, 'id_status_milik')->label(false)->widget(Select2::classname(), [
            'data' => $dataKabupaten,
            'pluginOptions' => [
                'allowClear' => true
            ],
            'options' => [
                'prompt' => 'Pilih Status Milik',

            ]
        ]);
        ?>
    </div>
    <div class="col-sm-3 col-md-2">
        <?php $dataKabupaten = ArrayHelper::map(Propinsi::find()->asArray()->all(), 'id_propinsi', 'nama_propinsi');
        echo $form->field($model, 'id_propinsi')->label(false)->widget(Select2::classname(), [
            'data' => $dataKabupaten,
            'pluginOptions' => [
                'allowClear' => true
            ],
            'options' => [
                'prompt' => 'Pilih Provinsi',
                'onchange' => '
                                $.post( "' . Yii::$app->urlManager->createUrl('public/lists?id=') . '"+$(this).val(), function( data ) {
                                $( "select#sekolahsearch-id_kabupaten" ).html( data );
                                });
                    
            ']
        ]);
        ?>
    </div>
    <div class="col-sm-4 col-md-2">
        <?php $dataKabupaten = ArrayHelper::map(Kabupaten::find()->asArray()->all(), 'id_kabupaten', 'nama_kabupaten');
        echo $form->field($model, 'id_kabupaten')->label(false)->widget(Select2::classname(), [
            'data' => $dataKabupaten,
            'options' => ['placeholder' => 'Pilih Kabupaten ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
    <div class="col-sm-4 col-md-1">
            <?= Html::submitButton(CommonActionLabelEnum::SEARCH, ['class' => 'btn bg-olive']) ?>
            <?= Html::a(CommonActionLabelEnum::RESET,['/public'],['class'=> 'btn bg-navy']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
