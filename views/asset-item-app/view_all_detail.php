<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\common\utils\EncryptionDB;
use app\models\AppVocabularySearch;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem */

$this->title = $model->number1;
$this->params['breadcrumbs'][] = ['label' => 'Aset', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-item-view box box-primary">
    <div class="box-header with-border">
        <p>
            <?= Html::a('<i class="fa fa-inbox"></i> Export PDF', ['gen-pdf', 'id' => $model->id_asset_item], [
                'class' => 'btn btn-success',
            ]);
            ?>
        </p>
    </div>
	<div class="box-header with-border">
	  <h3 class="box-title"><?= AppVocabularySearch::getValueByKey('Detail Informasi Aset') ?></h3>

	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>
	<div class="box-body" style="">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_asset_item',
			//'number2',
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
			/*
			[
                'attribute'=>'assetItemLocation.address',
				
            ],
			*/
			[
				'label' => 'Type',
				'attribute' => 'assetItemType1.type_asset_item',
			],
			[
				'label' => 'Status',
				'attribute' => 'assetItemType2.type_asset_item',
			],
			'label1',
			'label2',
			[
                //'label' => 'Supplier Name',
                'attribute'=>'assetMaster.typeAsset1.type_asset',
				
                //'filter'=>Html::activeDropDownList($searchModel, 'id_supplier', $datalist, ['class' => 'form-control']),
            ],
			/*
			[
                'attribute'=>'assetReceived.notes1',
            ],
			[
                'attribute'=>'assetItemLocation.keterangan1',
            ],
			*/ 
			[
                'attribute'=>'assetItemLocation.latitude',
            ],
			[
                'attribute'=>'assetItemLocation.longitude',
            ],
			/*
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
			*/ 
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

<div class="dokumentasi-view box box-primary">	
	<div class="box-header with-border">
	  <h3 class="box-title"><?= AppVocabularySearch::getValueByKey('Dokumentasi') ?></h3>

	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>
	<div class="box-body" style="">
		<div class="row">
			<?php
			for($i=1;$i<=5;$i++){
				$fieldname = "picture".$i;
				$captionfield = "caption_picture".$i;
				if ($model->$fieldname != "") {
			?>
			<div class="col-md-6">
			<?php
				if ($model->$fieldname != "") {
					$label = "Re-Upload Gambar";
					$res = '<img src="' . '../..' . '/web/images/asset_item/' . $model->$fieldname . '" class="img-responsive">';
				} else {
					$res = '<small class="label bg-orange">Gambar tidak ada</small><Br>';
					$label = "Upload Gambar";
				}
				$res .= '<br>';
				
				$url = Url::toRoute(['/asset-item/view-detail', 'c' => $model->id_asset_item]);
				//$res .= Html::a($label, $url, ['class' => 'btn btn-sm btn-success btn-block']);

				if($model->$captionfield != ""){
					$cap = $model->$captionfield;
				}else{
					$cap = "-- No Caption--";
				}
				echo '<div class="box-footer box-comments" style="">'.$cap.'</div>';
				echo $res;
			?>
			</div>
			<?php
				}
			}
			?>
		</div>
	</div>
	<div class="box-header with-border">
	<h4>File</h4>
	<?php
		if($model->file1 != ""){
			$label = "Re-Upload File";
			//$res = '<small class="label bg-green-gradient">'.$model->file1.'</small><Br>';
			$ic = EncryptionDB::encryptor('encrypt', $model->id_asset_item);
			$urld = Url::toRoute(['/asset-item/download-file', 'c' => $ic,'i'=>1]);
			$res = Html::a("Download File", $urld, ['class' => 'btn btn-sm btn-warning']);
		}else{
			$label = "Upload New File";
			$res = '<small class="label bg-red-gradient">Tidak ada file</small><Br>';
			$res .= '<br>';
		}
	 
		//echo $model->file1;
		echo $res;
	?>
	</div>
</div>

<div class="map-view box box-primary">	
	<div class="box-header with-border">
	  <h3 class="box-title"><?= AppVocabularySearch::getValueByKey('Posisi Aset') ?></h3>

	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>

	<div class="box-body" style="">
	<?= $this->render('/asset-item-location/map/_map_single', [
			'model' => $modelItemLocation,
		]) ?>
	</div>
</div>
	

