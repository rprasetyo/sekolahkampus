<?php

use app\common\utils\EncryptionDB;
use app\models\AssetItemLocation;
use app\models\AssetMaster;
use app\models\AssetReceived;
use app\models\TypeAssetItem1;
use app\models\TypeAssetItem2;
use app\models\Kelurahan;
use app\models\Kecamatan;
use app\models\Kabupaten;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssetItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pencarian Data Asset';
$this->params['breadcrumbs'][] = $this->title;
$datalist = ['' => 'Choose'] + ArrayHelper::map(AssetMaster::find()->all(), 'id_asset_master', 'asset_name');
$asset_code_list = ['' => 'Choose'] + ArrayHelper::map(AssetMaster::find()->all(), 'id_asset_master', 'asset_code');
$asset_type_asset_item1 = ['' => 'Choose'] + ArrayHelper::map(TypeAssetItem1::find()->all(), 'id_type_asset_item', 'type_asset_item');
$asset_type_asset_item2 = ['' => 'Choose'] + ArrayHelper::map(TypeAssetItem2::find()->all(), 'id_type_asset_item', 'type_asset_item');
$asset_received_list = ['' => 'Choose'] + ArrayHelper::map(AssetReceived::find()->all(), 'id_asset_received', 'notes1');
$asset_item_location_list = ['' => 'Choose'] + ArrayHelper::map(AssetItemLocation::find()->all(), 'id_asset_item_location', 'address');
$asset_kelurahan = ['' => 'Choose'] + ArrayHelper::map(Kelurahan::find()->all(), 'id_kelurahan', 'nama_kelurahan');
$asset_kecamatan = ['' => 'Choose'] + ArrayHelper::map(Kecamatan::find()->all(), 'id_kecamatan', 'nama_kecamatan');
$asset_kabupaten = ['' => 'Choose'] + ArrayHelper::map(Kabupaten::find()->all(), 'id_kabupaten', 'nama_kabupaten');
$asset_item_keterangan_list = ['' => 'Choose'] + ArrayHelper::map(AssetItemLocation::find()->all(), 'id_asset_item_location', 'keterangan1');
$asset_item_latitude_list = ['' => 'Choose'] + ArrayHelper::map(AssetItemLocation::find()->all(), 'id_asset_item_location', 'latitude');
$asset_item_longitude_list = ['' => 'Choose'] + ArrayHelper::map(AssetItemLocation::find()->all(), 'id_asset_item_location', 'longitude');
$asset_item_batas_utara_list = ['' => 'Choose'] + ArrayHelper::map(AssetItemLocation::find()->all(), 'id_asset_item_location', 'batas_utara');
//$datatype_asset = ['' => 'Choose'] + ArrayHelper::map(AssetMaster::find()->all(), 'id_type_asset1', 'type_asset');

?>
<div class="asset-item-list box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
	<?php
		
		$models = $dataProvider->getModels();
		/*
		foreach($models as $model){
			echo "==>".$model->number1."<br>";
		}
		*/
	?>
    <?php
    Modal::begin(
        [
            'id' => 'modal',
            'header' => '<h4>Upload Image</h4>',
            'size' => 'modal-lg',
        ]);

    echo "<div id='modalContent'></div>";

    Modal::end();
    ?>
    <div class="box-body">
        <?php Pjax::begin(['id' => 'pjax-grid-view']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax' => true,
            'striped' => true,
//            'responsive' => false,
            'responsiveWrap' => false,
            'hover' => true,
            'panel' => ['type' => 'primary', 'heading' => '<span class="fa fa-cube"></span> Data Asset'],
            'toggleDataContainer' => ['class' => 'btn-group mr-2'],
            'toolbar' => [
                [
                    'content' =>
                        Html::a(' <span class="fa fa-repeat"></span>', ['asset-item/list'], [
                            'class' => 'btn btn-default',
                            'title' => 'Refresh Data'
                        ]),

                ],
                '{toggleData}',
                '{export}'
            ],
            'export' => [
                'label' => 'Export',
            ],
            'exportConfig' => [
                GridView::EXCEL => [
                    'label' => 'Save as EXCEL',
                    'iconOptions' => ['class' => 'text-success'],
                    'showHeader' => true,
                    'showPageSummary' => true,
                    'showFooter' => true,
                    'showCaption' => true,
                    'filename' => 'Asset',
                    'alertMsg' => 'Export Data to Excel.',
                    'mime' => 'application/vnd.ms-excel',
                    'config' => [
                        'worksheet' => 'ExportWorksheet',
                        'cssFile' => ''
                    ],

                ],
                GridView::CSV => [
                    'label' => 'Save as CSV',
                    'iconOptions' => ['class' => 'text-primary'],
                    'showHeader' => true,
                    'showPageSummary' => true,
                    'showFooter' => true,
                    'showCaption' => true,
                    'filename' => 'Asset',
                    'alertMsg' => 'Export Data to CSV.',
                    'options' => ['title' => 'Comma Separated Values'],
                    'mime' => 'application/csv',
                    'config' => [
                        'colDelimiter' => ",",
                        'rowDelimiter' => "\r\n",
                    ],
                ],
            ],
            'columns' => [
                [
                    'header' => 'No',
                    'class' => 'kartik\grid\SerialColumn'
                ],
                [
                    'attribute' => 'number1',
                    'width' => '80px',
                ],
                [
                    //'label' => 'Supplier Name',
                    'attribute' => 'assetMaster.asset_name',
                    'filter' => Html::activeDropDownList($searchModel, 'id_asset_master', $datalist, ['class' => 'form-control']),
                ],

                /*[
                    'attribute' => 'id_asset_master',
                    'value' => function ($model, $key, $index, $widget) {
                        return $model->assetcode->nama_dokter;
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(AssetMaster::find()->orderBy('asset_code')->asArray()->all(), 'id_asset_master', 'asset_code'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => 'Any Dokter'],
                    //'group' => true,  // enable grouping
                ],*/

                [
                    //'label' => 'Supplier Name',
                    'attribute' => 'assetMaster.asset_code',
                    'width' => '80px',
                    //'filter' => Html::activeDropDownList($searchModel, 'id_asset_master', $asset_code_list, ['class' => 'form-control']),
                ],
				[
                    'label' => 'Type',
                    'attribute' => 'assetItemType1.type_asset_item',
                    'width' => '80px',
                    'filter' => Html::activeDropDownList($searchModel, 'id_type_asset_item1', $asset_type_asset_item1, ['class' => 'form-control']),
                ],
				[
                    'label' => 'Status',
                    'attribute' => 'assetItemType2.type_asset_item',
                    'width' => '80px',
                    'filter' => Html::activeDropDownList($searchModel, 'id_type_asset_item2', $asset_type_asset_item2, ['class' => 'form-control']),
                ],
				/*
                [
                    'attribute' => 'assetItemLocation.address',
                    'filter' => Html::activeDropDownList($searchModel, 'id_asset_item_location', $asset_item_location_list, ['class' => 'form-control']),
                    'options' => ['width' => '200']
                ],
				*/
				[
                    'attribute' => 'assetItemLocation.kelurahan.nama_kelurahan',
                    'filter' => Html::activeDropDownList($searchModel, 'id_kelurahan', $asset_kelurahan, ['class' => 'form-control']),
                    'options' => ['width' => '200']
                ],
				[
                    'attribute' => 'assetItemLocation.kecamatanOne.nama_kecamatan',
                    'filter' => Html::activeDropDownList($searchModel, 'id_kecamatan', $asset_kecamatan, ['class' => 'form-control']),
                    'options' => ['width' => '200']
                ],
				[
                    'attribute' => 'assetItemLocation.kabupatenOne.nama_kabupaten',
                    'filter' => Html::activeDropDownList($searchModel, 'id_kabupaten', $asset_kabupaten, ['class' => 'form-control']),
                    'options' => ['width' => '200']
                ],
                [
                    //'label' => 'Supplier Name',
                    'attribute' => 'assetMaster.typeAsset1.type_asset',
                    'contentOptions' => ['style' => 'width: 200px;', 'class' => 'text-left'],
//                    'filter'=>Html::activeDropDownList($searchModel, 'id_type_asset1', $datatype_asset, ['class' => 'form-control']),
                ],
                [
                    'attribute' => 'assetReceived.notes1',
                    //'filter' => Html::activeDropDownList($searchModel, 'id_asset_received', $asset_received_list, ['class' => 'form-control']),

                ],
                [
                    'attribute' => 'assetItemLocation.keterangan1',
                    //'filter' => Html::activeDropDownList($searchModel, 'id_asset_item_location', $asset_item_keterangan_list, ['class' => 'form-control']),

                ],
                [
                    'attribute' => 'assetItemLocation.latitude',
                    //'filter' => Html::activeDropDownList($searchModel, 'id_asset_item_location', $asset_item_latitude_list, ['class' => 'form-control']),

                ],
                [
                    'attribute' => 'assetItemLocation.longitude',
                    //'filter' => Html::activeDropDownList($searchModel, 'id_asset_item_location', $asset_item_longitude_list, ['class' => 'form-control']),

                ],
                [
                    'attribute' => 'assetItemLocation.batas_utara',
                    //'filter' => Html::activeDropDownList($searchModel, 'id_asset_item_location', $asset_item_batas_utara_list, ['class' => 'form-control']),

                ],
                [
                    'attribute' => 'assetItemLocation.batas_selatan',
                ],
                [
                    'attribute' => 'assetItemLocation.batas_barat',
                ],
                [
                    'attribute' => 'assetItemLocation.batas_timur',
                ],
                [
                    'attribute' => 'assetItemLocation.luas',
                ],
                [
                    'attribute' => 'assetReceived.received_year',
                ],
                [
                    'attribute' => 'assetReceived.price_received',
                    'contentOptions' => ['style' => 'width: 200px;', 'class' => 'text-right'],
                ],
                [
                    //'label' => 'Supplier Name',
                    'attribute' => 'assetReceived.statusReceived.status_received',

                    //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
                ],
				/*
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{upload-image}',
                    'header' => 'Image',// the default buttons + your custom button
                    'contentOptions' => ['style' => 'width: 180px;'],
                    'buttons' => [
                        'upload-image' => function ($url, $model, $key) {
                            $id = $model->id_asset_item;
                            if ($model->picture1 != "") {
                                $label = "Re-Upload Image";
                                $res = '<img src="' . '../..' . '/web/images/' . $model->picture1 . '" class="img-responsive">';
                            } else {
                                $label = "Upload New Image";
                                $res = '<small class="label bg-orange">Gambar tidak ada</small><Br>';
                            }
                            $res .= '<br>';
                            $res .= Html::button('Upload New Image',
                                ['value' => Url::to(['asset-item/upload-image','id' => $id]),
                                    'title' => 'Upload Image ', 'class' => 'showModalButton btn btn-sm btn btn-success btn-block']);

                            if ($model->picture1 != "") {
                                $ic = EncryptionDB::encryptor('encrypt', $model->id_asset_master);
                                $urlreset = Url::toRoute(['reset-default-image', 'c' => $ic]);
                                $res .= Html::a('Reset To Default Image', $urlreset,
                                    [
                                        'class' => 'btn btn-sm btn-warning btn-block',
                                        'data' => [
                                            'confirm' => 'Are you sure want to reset?',
                                            'method' => 'post',
                                        ],
                                    ]);
                            }
                            return $res;
                        }
                    ]
                ],
                ['class' => 'yii\grid\ActionColumn',
                    'template' => ' {status-action}',  // the default buttons + your custom button
                    'header' => 'Lihat di Peta',
                    'buttons' => [
                        'status-action' => function ($url, $model, $key) {     // render your custom button
                            $ic = EncryptionDB::encryptor('encrypt', $model->id_asset_item_location);
                            $urlpeta = Url::toRoute(['/asset-item-location/view-map', 'c' => $ic]);
                            return Html::a('Lihat di Peta', $urlpeta, ['class' => 'btn btn-sm btn-primary']);
                        }
                    ]
                ],
                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => 'width: 120px;'],
                    'template' => '{view} {delete}',
                ],
				*/

            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>

<div class="map-view box box-primary">	
	<div class="box-header with-border">
	  <h3 class="box-title">Peta Geografi</h3>

	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>

	<div class="box-body" style="">
	<?= $this->render('list-search/_map_multiple', [
			'models' => $models,
		]) ?>
	</div>
</div>
