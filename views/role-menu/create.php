<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoleMenu */

$this->title = 'Create Role Menu';
$this->params['breadcrumbs'][] = ['label' => 'Role Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-menu-create">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
