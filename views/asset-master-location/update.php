<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterLocation */

$this->title = 'Update Asset Master Location';
$this->params['breadcrumbs'][] = ['label' => 'Asset Master Location', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Asset Master Location', 'url' => ['view', 'id' => $model->id_asset_master_location]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-master-location-update">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
