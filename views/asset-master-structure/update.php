<?php

use app\common\labeling\CommonActionLabelEnum;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterStructure */

$this->title = CommonActionLabelEnum::UPDATE.' Asset Master Structure';
// $this->params['breadcrumbs'][] = ['label' => 'Asset Master Structure', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id_asset_master_structure, 'url' => ['view', 'id' => $model->id_asset_master_structure]];
$this->params['breadcrumbs'][] = CommonActionLabelEnum::UPDATE;
?>
<div class="asset-master-structure-update">

    <!-- <h1><?php Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
