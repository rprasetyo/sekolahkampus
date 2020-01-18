<?php

use app\common\labeling\CommonActionLabelEnum;

/* @var $this yii\web\View */
/* @var $model app\models\AuthMenu */

$this->title = CommonActionLabelEnum::UPDATE . ' Auth Menu';
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL . ' Auth Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::DETAIL . ' Auth Menu', 'url' => ['view', 'id' => $model->id_auth_menu]];
$this->params['breadcrumbs'][] = CommonActionLabelEnum::UPDATE;
?>
<div class="auth-menu-update">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
