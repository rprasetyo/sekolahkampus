<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppFieldConfig */

$this->title = 'Update App Field Config';
$this->params['breadcrumbs'][] = ['label' => 'App Field Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail App Field Config', 'url' => ['view', 'id' => $model->id_app_field_config]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="app-field-config-update">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
