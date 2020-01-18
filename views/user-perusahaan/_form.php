<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserPerusahaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-perusahaan-form box box-primary">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
//            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-10',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>
    <div class="box-body table-responsive">
        <div class="col-md-12">
            <?= $form->field($model, 'id_user')->textInput() ?>

            <?= $form->field($model, 'id_perusahaan')->textInput() ?>

            <!--        <? //= $form->field($model, 'created_date')->textInput() ?>-->

            <!--        <? //= $form->field($model, 'created_user')->textInput() ?>-->

            <!--        <? //= $form->field($model, 'created_ip_address')->textInput(['maxlength' => true]) ?>-->

        </div>
        <div class="box-footer">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>