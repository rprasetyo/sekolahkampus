<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem */

$this->title = $model->assetItemLocation->address;
$this->params['breadcrumbs'][] = ['label' => 'Asset Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-item-view box box-primary">
	<div class="box box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_asset_item',
			'number1',
//            'id_asset_item',
            //'id_asset_master',
			[
                //'label' => 'Supplier Name',
                'attribute'=>'assetMaster.asset_name',
                //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
            ],
			[
                //'label' => 'Supplier Name',
                'attribute'=>'assetMaster.asset_code',
                //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
            ],
			[
                'attribute'=>'assetItemLocation.address',
				
            ],
			[
                //'label' => 'Supplier Name',
                'attribute'=>'assetMaster.typeAsset1.type_asset',
				
                //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
            ],
			[
                'attribute'=>'assetReceived.notes1',
            ],
			[
                'attribute'=>'assetItemLocation.keterangan1',
            ],
			[
                'attribute'=>'assetItemLocation.latitude',
            ],
			[
                'attribute'=>'assetItemLocation.longitude',
            ],
			[
                'attribute'=>'assetItemLocation.batas_utara',
            ],
			[
                'attribute'=>'assetItemLocation.batas_selatan',
            ],
			[
                'attribute'=>'assetItemLocation.batas_barat',
            ],
			[
                'attribute'=>'assetItemLocation.batas_timur',
            ],
			[
                'attribute'=>'assetItemLocation.luas',
            ],
			[
                'attribute'=>'assetReceived.received_year',
            ],
			[
                'attribute'=>'assetReceived.price_received',
				
            ],
			[
                //'label' => 'Supplier Name',
                'attribute'=>'assetReceived.statusReceived.status_received',
				
                //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
            ],
        ],
    ]) ?>
	</div>
</div>
