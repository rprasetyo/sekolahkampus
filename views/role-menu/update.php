<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoleMenu */

$this->title = 'Update Role Menu: ' . $model->menu;
$this->params['breadcrumbs'][] = ['label' => 'Role Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Role Menu', 'url' => ['view', 'id' => $model->id_role_menu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="role-menu-update">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
