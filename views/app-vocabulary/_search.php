<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppVocabularySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-vocabulary-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_app_vocabulary') ?>

    <?= $form->field($model, 'master_vocab') ?>

    <?= $form->field($model, 'vocab_lang1') ?>

    <?= $form->field($model, 'vocab_lang2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
