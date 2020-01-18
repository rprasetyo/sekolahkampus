<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterLocation */

$this->title = 'Detail Asset Master Location';
$this->params['breadcrumbs'][] = ['label' => 'Asset Master Location', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-master-location-view box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< Back', ['index'], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id_asset_master_location], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_asset_master_location], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id_asset_master_location',
            [
                'attribute' => 'assetMaster.asset_name'
            ],
            'latitude',
            'longitude',
            'address',
            'desa',
            'kecamatan',
            'kabupaten',
            'provinsi',
            'kodepos',
        ],
    ]) ?>

</div>
