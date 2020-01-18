<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoleUserAccess */

$this->title = 'Create Role User Access';
$this->params['breadcrumbs'][] = ['label' => 'Role User Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-user-access-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
