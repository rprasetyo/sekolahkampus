<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterFieldConfig */

$this->title = 'Create Asset Master Field Config';
$this->params['breadcrumbs'][] = ['label' => 'Asset Master Field Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-master-field-config-create">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
