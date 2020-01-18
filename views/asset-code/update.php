<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetCode */

$this->title = 'Update Asset Code: ' . $model->id_asset_code;
$this->params['breadcrumbs'][] = ['label' => 'Asset Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_asset_code, 'url' => ['view', 'id' => $model->id_asset_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-code-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
