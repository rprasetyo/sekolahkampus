<?php

use app\common\labeling\CommonActionLabelEnum;

/* @var $this yii\web\View */
/* @var $model app\models\AuthMenu */

$this->title = CommonActionLabelEnum::CREATE . ' Auth Menu';
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL . ' Auth Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-menu-create">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
