<?php

use app\common\labeling\CommonActionLabelEnum;
use app\common\utils\EncryptionDB;
use app\models\AppVocabularySearch;
use app\models\TypeAssetItem1;
use app\models\TypeAssetItem2;
use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssetItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = CommonActionLabelEnum::LIST_ALL ." " . AppVocabularySearch::getValueByKey('Data Aset');
$this->params['breadcrumbs'][] = $this->title;

$asset_type_asset_item1 = ['' => CommonActionLabelEnum::CHOOSE_PROMPT] + ArrayHelper::map(TypeAssetItem1::find()->all(), 'id_type_asset_item', 'type_asset_item');
$asset_type_asset_item2 = ['' => CommonActionLabelEnum::CHOOSE_PROMPT] + ArrayHelper::map(TypeAssetItem2::find()->all(), 'id_type_asset_item', 'type_asset_item');
$asset_kelurahan = ['' => CommonActionLabelEnum::CHOOSE_PROMPT] + ArrayHelper::map(Kelurahan::find()->all(), 'id_kelurahan', 'nama_kelurahan');
$asset_kecamatan = ['' => CommonActionLabelEnum::CHOOSE_PROMPT] + ArrayHelper::map(Kecamatan::find()->all(), 'id_kecamatan', 'nama_kecamatan');
$asset_kabupaten = ['' => CommonActionLabelEnum::CHOOSE_PROMPT] + ArrayHelper::map(Kabupaten::find()->all(), 'id_kabupaten', 'nama_kabupaten');

?>
<div class="asset-item-index box box-primary">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a(CommonActionLabelEnum::CREATE, ['create'], ['class' => 'btn btn-success']) ?>

            <?php
            /*
            <?= Html::button('Import File',
                ['value' => Url::to(['/asset-item/import-file']),
                    'title' => 'Upload Data', 'class' => 'showModalButton btn btn-success']); ?>
            <?= Html::label( Yii::t('app', 'Page size: '), 'pagesize', array( 'style' => 'margin-left:10px; margin-top:8px;' ) ) ?>

            <?= Html::dropDownList(
                'pagesize',
                ( isset($_GET['pagesize']) ? $_GET['pagesize'] : 20 ),  // set the default value for the dropdown list
                // set the key and value for the drop down list
                array(
                    20 => 20,
                    50 => 50,
                    100 => 100),
                // add the HTML attritutes for the dropdown list
                // I add pagesize as an id of dropdown list. later on, I will add into the Gridview widget.
                // so when the form is submitted, I can get the $_POST value in InvoiceSearch model.
                array(
                    'id' => 'pagesize',
                    'style' => 'margin-left:5px; margin-top:8px;'
                )
            )
            ?>
            */
            ?>
        </p>
    </div>
    <?php
    Modal::begin(
        [
            'id' => 'modal',
            'header' => '<h4>Import Data File</h4>',
            'size' => 'modal-lg',
        ]);

    echo "<div id='modalContent'></div>";

    Modal::end();
    ?>
    <div class="box-body table-responsive">
        <?php Pjax::begin(['id' => 'data-pjax="0"']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,

            'filterModel' => $searchModel,
            'layout'=>'{summary}'.Html::activeDropDownList($searchModel, 'myPageSize', [10 => 10, 20 => 20, 50 => 50, 100 => 100],['id'=>'myPageSize'])."{items}<br/>{pager}",
            'filterSelector' => '#myPageSize',

            'columns' => [
				/*
                [
                    'header' => 'No',
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions'=>[ 'style'=>'vertical-align: top; ','class' => 'text-center'],

                ],
				*/
                'number2',
                'number1',
//            'id_asset_item',
                //'id_asset_master',
                [
                    //'label' => 'Supplier Name',
                    'attribute' => 'assetMaster.asset_name',
                    'contentOptions' => ['style' => 'width:350px;  min-width:300px;  '],
                    //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
                ],
                // [
                //     'attribute' => 'sensor.sensor_name',
                // ],
                [
                    //'label' => 'Supplier Name',
                    'attribute' => 'assetMaster.asset_code',
                    //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
                ],
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
                'label1',
                'label2',
				[
                    'label' => 'Nama Keluarahan',
                    'attribute' => 'assetItemLocation.kelurahan.nama_kelurahan',
                    //'filter' => Html::activeDropDownList($searchModel, 'id_kelurahan', $asset_kelurahan, ['class' => 'form-control']),
                    'options' => ['width' => '200']
                ],
                [
                    'attribute' => 'assetItemLocation.kecamatanOne.nama_kecamatan',
                    //'filter' => Html::activeDropDownList($searchModel, 'id_kecamatan', $asset_kecamatan, ['class' => 'form-control']),
                    'options' => ['width' => '200']
                ],
                [
                    'attribute' => 'assetItemLocation.kabupatenOne.nama_kabupaten',
                    //'filter' => Html::activeDropDownList($searchModel, 'id_kabupaten', $asset_kabupaten, ['class' => 'form-control']),
                    'options' => ['width' => '200']
                ],
                /*
                [
                    'label' => 'Lokasi 1',
                    'attribute' => 'assetItemLocation.address',
                    'headerOptions' => ['width' => '500px'],
//				'options' => ['width' => '200']
                ],
                */
				/*
                [
                    'label' => 'Type Asset',
                    'attribute' => 'assetMaster.typeAsset1.type_asset',
                    'contentOptions' => ['style' => 'width: 1000px;', 'class' => 'text-left'],
                    //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
                ],
				*/
                [
                    'attribute' => 'assetReceived.notes1',
                ],
                [
                    'attribute' => 'assetItemLocation.keterangan1',
                ],
                [
                    'attribute' => 'assetItemLocation.latitude',
                ],
                [
                    'attribute' => 'assetItemLocation.longitude',
                ],
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

                            if($model->picture1 != ""){
                                $ic = EncryptionDB::encryptor('encrypt',$model->id_asset_item);
                                $urlreset = Url::toRoute(['reset-image-index', 'c'=>$ic]);
                                $res .= Html::a('Reset Image', $urlreset,
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
                        'upload-file' => function ($url, $model, $key) {
                            if ($model->file1 != "") {
                                $label = "Re-Upload File";
                                //$res = '<small class="label bg-green-gradient">'.$model->file1.'</small><Br>';
                                $ic = EncryptionDB::encryptor('encrypt', $model->id_asset_item);
                                $urld = Url::toRoute(['/asset-item/download-file', 'c' => $ic, 'i' => 1]);
                                $res = Html::a("Download File", $urld, ['class' => 'btn btn-sm btn-warning btn-block']);
                            } else {
                                $label = "Upload New File";
                                $res = '<small class="label bg-red-gradient">Tidak ada file</small><Br>';
                                $res .= '<br>';
                            }

                            $res .= Html::a($label, $url, ['class' => 'btn btn-sm btn-primary btn-block']);

                            if ($model->file1 != "") {
                                $ic = EncryptionDB::encryptor('encrypt', $model->id_asset_item);
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
                            $urlpeta = Url::toRoute(['/asset-item/view-detail', 'c' => $ic]);
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
