<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CpanelLeftmenu */

$this->title = 'Create Cpanel Leftmenu';
$this->params['breadcrumbs'][] = ['label' => 'Cpanel Leftmenus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpanel-leftmenu-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
