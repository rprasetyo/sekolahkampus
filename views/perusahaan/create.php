<?php


/* @var $this yii\web\View */
/* @var $model app\models\Perusahaan */

$this->title = 'Tambah Perusahaan';
$this->params['breadcrumbs'][] = ['label' => 'Perusahaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perusahaan-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
