<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CpanelLeftmenu */

$this->title = 'Update Cpanel Leftmenu: ' . $model->id_leftmenu;
$this->params['breadcrumbs'][] = ['label' => 'Cpanel Leftmenus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_leftmenu, 'url' => ['view', 'id' => $model->id_leftmenu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cpanel-leftmenu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
