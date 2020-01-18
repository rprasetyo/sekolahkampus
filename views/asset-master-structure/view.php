<?php

use app\common\labeling\CommonActionLabelEnum;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterStructure */

$this->title = CommonActionLabelEnum::DETAIL . ' Asset Master Structure';
// $this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL.' Asset Master Structure', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-master-structure-view box box-success">

    <!-- <h1><?php Html::encode($this->title) ?></h1> -->

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< ' . CommonActionLabelEnum::BACK, ['index'], ['class' => 'btn btn-warning']) ?>
            <?= Html::a(CommonActionLabelEnum::UPDATE, ['update', 'id' => $model->id_asset_master_structure], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(CommonActionLabelEnum::DELETE, ['delete', 'id' => $model->id_asset_master_structure], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => CommonActionLabelEnum::CONFIRM_DELETE,
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id_asset_master_structure',
                [
                    'label' => 'Asset Master Parent',
                    'attribute' => 'assetMasterParent.asset_name',
                ],
                [
                    'label' => 'Asset Master Child',
                    'attribute' => 'assetMasterChild.asset_name'
                ]
            ],
        ]) ?>
    </div>
</div>