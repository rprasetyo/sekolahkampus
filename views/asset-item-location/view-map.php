<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItemLocation */

$this->title = 'Lokasi Barang';
$this->params['breadcrumbs'][] = ['label' => 'Lokasi Barang', 'url' => ['/asset-item/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-item-location-view box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <div class="box-header with-border">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//                'id_asset_item_location',
                ['attribute' => 'assetMaster.asset_name'],
                //'latitude',
                //'longitude',
                'address',
            ],
        ]) ?>
		
		<?= $this->render('map/_map_single', [
			'model' => $model,
		]) ?>
    </div>
</div>
