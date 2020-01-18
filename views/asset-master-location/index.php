<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssetMasterLocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Master Location';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-master-location-index box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a('Create Asset Master Location', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//                'id_asset_master_location',
                'id_asset_master',
                'latitude',
                'longitude',
                'address',
                //'desa',
                //'kecamatan',
                //'kabupaten',
                //'provinsi',
                //'kodepos',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
</div>
