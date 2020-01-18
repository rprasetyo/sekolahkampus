<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItemLocation */

$this->title = 'Detail Asset Item Location';
$this->params['breadcrumbs'][] = ['label' => 'Asset Item Location', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-item-location-view box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< Back', ['index'], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id_asset_item_location], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_asset_item_location], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//                'id_asset_item_location',
                ['attribute' => 'assetMaster.asset_name'],
                'latitude',
                'longitude',
                'address',
//                'desa',
//                'kecamatan',
//                'kabupaten',
//                'provinsi',
                'kelurahan.nama_kelurahan',
                'kecamatanOne.nama_kecamatan',
                'kabupatenOne.nama_kabupaten',
                'propinsi.nama_propinsi',
                'kodepos',
            ],
        ]) ?>
    </div>
</div>
