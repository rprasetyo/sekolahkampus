<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoleUserAccess */

$this->title = 'Update Role User Access: ' . $model->id_role_user_access;
$this->params['breadcrumbs'][] = ['label' => 'Role User Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_role_user_access, 'url' => ['view', 'id' => $model->id_role_user_access]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="role-user-access-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
