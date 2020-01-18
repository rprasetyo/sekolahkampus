<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppSetting */

$this->title = 'Tambah Setting Aplikasi';
$this->params['breadcrumbs'][] = ['label' => 'Setting Aplikasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-setting-create">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
