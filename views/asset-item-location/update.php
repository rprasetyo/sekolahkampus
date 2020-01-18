<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItemLocation */

$this->title = 'Update Asset Item Location';
$this->params['breadcrumbs'][] = ['label' => 'Asset Item Location', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Asset Item Location', 'url' => ['view', 'id' => $model->id_asset_item_location]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-item-location-update">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
