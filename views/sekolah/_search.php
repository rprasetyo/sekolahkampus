<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SekolahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sekolah-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_sekolah') ?>

    <?= $form->field($model, 'nama_sekolah') ?>

    <?= $form->field($model, 'nama_sekolah_singkat') ?>

    <?= $form->field($model, 'alias1') ?>

    <?= $form->field($model, 'alias2') ?>

    <?php // echo $form->field($model, 'alias3') ?>

    <?php // echo $form->field($model, 'id_jenis_sekolah') ?>

    <?php // echo $form->field($model, 'id_status_milik') ?>

    <?php // echo $form->field($model, 'alamat1') ?>

    <?php // echo $form->field($model, 'alamat2') ?>

    <?php // echo $form->field($model, 'alamat3') ?>

    <?php // echo $form->field($model, 'id_kabupaten') ?>

    <?php // echo $form->field($model, 'id_propinsi') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'medsos1') ?>

    <?php // echo $form->field($model, 'medsos2') ?>

    <?php // echo $form->field($model, 'medsos3') ?>

    <?php // echo $form->field($model, 'medsos4') ?>

    <?php // echo $form->field($model, 'medsos5') ?>

    <?php // echo $form->field($model, 'description1') ?>

    <?php // echo $form->field($model, 'description2') ?>

    <?php // echo $form->field($model, 'description3') ?>

    <?php // echo $form->field($model, 'description4') ?>

    <?php // echo $form->field($model, 'description5') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
