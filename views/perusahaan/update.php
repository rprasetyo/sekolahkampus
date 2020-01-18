<?php

/* @var $this yii\web\View */
/* @var $model app\models\Perusahaan */

$this->title = 'Update Perusahaan: ' . $model->nama_perusahaan;
$this->params['breadcrumbs'][] = ['label' => 'Perusahaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_perusahaan, 'url' => ['view', 'id' => $model->id_perusahaan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="perusahaan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
