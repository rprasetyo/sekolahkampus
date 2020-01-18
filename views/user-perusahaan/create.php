<?php


/* @var $this yii\web\View */
/* @var $model app\models\UserPerusahaan */

$this->title = 'Create User Perusahaan';
$this->params['breadcrumbs'][] = ['label' => 'User Perusahaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-perusahaan-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
