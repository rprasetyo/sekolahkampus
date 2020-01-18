<?php

/* @var $this yii\web\View */
/* @var $model app\models\UserPerusahaan */

$this->title = 'Update User Perusahaan: ' . $model->id_user_perusahaan;
$this->params['breadcrumbs'][] = ['label' => 'User Perusahaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_user_perusahaan, 'url' => ['view', 'id' => $model->id_user_perusahaan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-perusahaan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
