<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppSetting */

$this->title = 'Edit Setting Aplikasi';
$this->params['breadcrumbs'][] = ['label' => 'Setting Aplikasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Detail Setting Aplikasi', 'url' => ['view', 'id' => $model->id_app_setting]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="app-setting-update">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
