<?php

use app\models\AssetMaster;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssetItemLocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Item Location';
$this->params['breadcrumbs'][] = $this->title;

$dataList1 = ['' => 'Choose'] + ArrayHelper::map(AssetMaster::find()->all(), 'id_asset_master', 'asset_name');
?>
<div class="asset-item-location-index box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a('Create Asset Item Location', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => 'No',
                'class' => 'yii\grid\SerialColumn'
            ],

//            'id_asset_item_location',
            [
                'attribute' => 'assetMaster.asset_name',
                'filter' => Html::activeDropDownList($searchModel, 'id_asset_master', $dataList1, ['class' => 'form-control']),
            ],
            'latitude',
            'longitude',
            'address',
            //'desa',
            //'kecamatan',
            //'kabupaten',
            //'provinsi',
            //'kodepos',
            //'id_kabupaten',
            //'id_propinsi',
            //'id_kecamatan',
            //'id_kelurahan',

            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
</div>
