<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KamusPetunjuk */

$this->title = 'Update Kamus Petunjuk';
$this->params['breadcrumbs'][] = ['label' => 'Kamus Petunjuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Kamus Petunjuk', 'url' => ['view', 'id' => $model->id_kamus_petunjuk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kamus-petunjuk-update">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
