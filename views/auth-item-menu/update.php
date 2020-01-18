<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItemMenu */

$this->title = 'Update Auth Item Menu: ' . $model->id_auth_item_menu;
$this->params['breadcrumbs'][] = ['label' => 'Auth Item Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_auth_item_menu, 'url' => ['view', 'id' => $model->id_auth_item_menu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-item-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
