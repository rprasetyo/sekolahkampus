<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem */

$this->title = 'Update Asset Item: ' . $model->id_asset_item;
$this->params['breadcrumbs'][] = ['label' => 'Asset Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_asset_item, 'url' => ['view', 'id' => $model->id_asset_item]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-item-update">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
