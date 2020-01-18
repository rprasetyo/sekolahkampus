<?php

use app\common\utils\EncryptionDB;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\TypeAssetItem1;
use app\models\TypeAssetItem2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssetItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Aset';
$this->params['breadcrumbs'][] = $this->title;

$asset_type_asset_item1 = ['' => 'Choose'] + ArrayHelper::map(TypeAssetItem1::find()->all(), 'id_type_asset_item', 'type_asset_item');
$asset_type_asset_item2 = ['' => 'Choose'] + ArrayHelper::map(TypeAssetItem2::find()->all(), 'id_type_asset_item', 'type_asset_item');

?>
<div class="asset-item-index box box-primary">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a('Tambah Aset', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <div class="box-body table-responsive">
        <?php Pjax::begin(['id' => 'data-pjax="0"']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'header' => 'No',
                    'class' => 'yii\grid\SerialColumn'
                ],
				//'number2',
                'number1',
//            'id_asset_item',
                //'id_asset_master',
                [
                    //'label' => 'Supplier Name',
                    'attribute' => 'assetMaster.asset_name',
                    //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
                ],
				/*
                [
                    //'label' => 'Supplier Name',
                    'attribute' => 'assetMaster.asset_code',
                    //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
                ],
				*/
				[
                    'label' => 'Type',
                    'attribute' => 'assetItemType1.type_asset_item',
                    'filter' => Html::activeDropDownList($searchModel, 'id_type_asset_item1', $asset_type_asset_item1, ['class' => 'form-control']),
                ],
                [
                    'label' => 'Status',
                    'attribute' => 'assetItemType2.type_asset_item',
                    'filter' => Html::activeDropDownList($searchModel, 'id_type_asset_item2', $asset_type_asset_item2, ['class' => 'form-control']),
                ],
                //'label1',
                'label2',
				/*
                [
                    'label' => 'Lokasi 1',
                    'attribute' => 'assetItemLocation.address',
                    'headerOptions' => ['width' => '500px'],
//				'options' => ['width' => '200']
                ],
				*/
                [
                    //'label' => 'Supplier Name',
                    'attribute' => 'assetMaster.typeAsset1.type_asset',
                    'contentOptions' => ['style' => 'width: 1000px;', 'class' => 'text-left'],
                    //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
                ],
				/*
                [
                    'attribute' => 'assetReceived.notes1',
                ],
                [
                    'attribute' => 'assetItemLocation.keterangan1',
                ],
				*/
                [
                    'attribute' => 'assetItemLocation.latitude',
                ],
                [
                    'attribute' => 'assetItemLocation.longitude',
                ],
				
				/*
                [
                    'attribute' => 'assetItemLocation.batas_utara',
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
					'format' => ['decimal', 2]
                ],
				*/
                [
                    'attribute' => 'assetReceived.received_year',
                ],
                [
                    'attribute' => 'assetReceived.price_received',
                    'contentOptions' => ['style' => 'width: 200px;', 'class' => 'text-right'],
                    'format' => ['decimal', 2]
                ],
                [
                    //'label' => 'Supplier Name',
                    'attribute' => 'assetReceived.statusReceived.status_received',

                    //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
                ],
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{upload-image}',
                    'header' => 'Dokumentasi',// the default buttons + your custom button
                    'contentOptions' => ['style' => 'width: 180px;'],
                    'buttons' => [
                        'upload-image' => function ($url, $model, $key) {
                            if ($model->picture1 != "") {
                                $label = "Re-Upload Gambar";
                                $res = '<img src="' . '../..' . '/web/images/asset_item/' . $model->picture1 . '" class="img-responsive">';
                            } else {
                                $res = '<small class="label bg-orange">Gambar tidak ada</small><Br>';
                                $label = "Upload Gambar";
                            }
                            $res .= '<br>';
                            $res .= Html::a($label, $url, ['class' => 'btn btn-sm btn-success btn-block']);

                            return $res;
                        }
                    ]
                ],
//                ['class' => 'yii\grid\ActionColumn',
//                    'template' => '{upload-file}',
//                    'header' => 'File Manual',// the default buttons + your custom button
//                    'contentOptions' => ['style' => 'width: 180px;'],
//                    'buttons' => [
//                        'upload-file' => function ($url, $model, $key) {
//                            if ($model->file1 != "") {
//                                $label = "Re-Upload File";
//                                $res = '<img src="' . '../..' . '/web/images/asset_item/' . $model->file1 . '" class="img-responsive">';
//                            } else {
//                                $res = '<small class="label bg-red-active">File tidak ada</small><Br>';
//                                $label = "Upload File";
//                            }
//                            $res .= '<br>';
//                            $res .= Html::a($label, $url, ['class' => 'btn btn-sm btn-primary btn-block']);
//
//                            return $res;
//                        }
//                    ]
//                ],
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{upload-file}',
                    'header' => 'Form Inventarisasi',// the default buttons + your custom button
                    //'contentOptions' => ['style' => 'width: 180px; padding:0px 0px 0px 30px; vertical-align: middle;'],
                    'buttons' => [
                        'upload-file' => function($url, $model, $key) {
                            if($model->file1 != ""){
                                $label = "Re-Upload File";
                                //$res = '<small class="label bg-green-gradient">'.$model->file1.'</small><Br>';
								$ic = EncryptionDB::encryptor('encrypt', $model->id_asset_item);
								$urld = Url::toRoute(['/asset-item-app/download-file', 'c' => $ic,'i'=>1]);
								$res = Html::a("Download File", $urld, ['class' => 'btn btn-sm btn-warning btn-block']);
                            }else{
                                $label = "Upload New File";
                                $res = '<small class="label bg-red-gradient">Tidak ada file</small><Br>';
								$res .= '<br>';
                            }
                           
                            $res .= Html::a($label, $url, ['class' => 'btn btn-sm btn-primary btn-block']);

                            if($model->file1 != ""){
                                $ic = EncryptionDB::encryptor('encrypt',$model->id_asset_item);
                            }
                            return $res;
                        }
                    ]
                ],
//
				/*
                ['class' => 'yii\grid\ActionColumn',
                    'template' => ' {status-action}',  // the default buttons + your custom button
                    'header' => 'Lihat di Peta',
                    'buttons' => [
                        'status-action' => function ($url, $model, $key) {     // render your custom button
                            $ic = EncryptionDB::encryptor('encrypt', $model->id_asset_item_location);
                            $urlpeta = Url::toRoute(['/asset-item-location/view-map', 'c' => $ic]);
                            return Html::a('Lihat di Peta', $urlpeta, ['class' => 'btn btn-sm btn-primary']);
                        }
                ]],
				*/
				['class' => 'yii\grid\ActionColumn',
                    'template' => ' {status-action}',  // the default buttons + your custom button
                    'header' => 'Detail',
                    'buttons' => [
                        'status-action' => function ($url, $model, $key) {     // render your custom button
                            $ic = EncryptionDB::encryptor('encrypt', $model->id_asset_item);
                            $urlpeta = Url::toRoute(['/asset-item-app/view-detail', 'c' => $ic]);
                            return Html::a('Detail', $urlpeta, ['class' => 'btn btn-sm btn-danger']);
                        }
                ]],
//            'number2',
//            'number3',
                //'picture1',
                //'picture2',
                //'picture3',
                //'id_asset_received',
                //'id_asset_item_location',

                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => 'width: 120px;'],
                    'template' => '{view}{update} {delete}',
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
