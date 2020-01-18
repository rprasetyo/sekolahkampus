<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use app\models\AssetMasterStructure;
use app\models\AssetItem_Generic;
use app\models\AssetItemSearch_Generic;
use app\models\TypeAssetItem3;
use yii\widgets\DetailView;

use app\common\utils\EncryptionDB;

use app\models\AppFieldConfigSearch;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem */

$this->title = CommonActionLabelEnum::VIEW ." " . AppVocabularySearch::getValueByKey('Informasi Asset');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey(' Asset Item '), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$dataListAssetTypeAsetItem3 = ArrayHelper::map(TypeAssetItem3::find()->asArray()->all(), 'id_type_asset_item', 'type_asset_item');
?>
<div class="asset-item-view box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title"><?= AppVocabularySearch::getValueByKey('Informasi Asset') ?></h3>

	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>
	<div class="box-body" style="">
    <?= $this->render('_view', [
        'model' => $model,
    ]) ?>
	</div>
</div>

<?php
\yii\bootstrap\Modal::begin([
    'header' => 'Tambah Aset',
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
\yii\bootstrap\Modal::end();
?>
<?php
	$datas= AssetMasterStructure::find()
			->where(['id_asset_master_parent' => $idparent])
			->orderBy(['id_asset_master_structure'=>SORT_ASC])
			->all();
	foreach($datas as $data){
		$labelAssetInSide = $data->assetMasterChild->asset_name;
		//echo $data->assetMasterChild->asset_name."--<br>";
?>
<div class="dokumentasi-view box box-success">	
	<div class="box-header with-border">
	  <h3 class="box-title"><?= $labelAssetInSide ?></h3>

	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>
	<div class="box-body" style="">
		<?php
		/*
		$url = Url::toRoute(['supplier-assesment/result', 'is'=>$id_asset_item, 'isa'=>$data->assetMasterChild->id_asset_master]);
		echo Html::a('<button type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Tambah Data '.$labelAssetInSide .'</button>', $url, [
			'title' => Yii::t('app', 'lead-view'),
		]);
		*/
		$varian_group = "id_asset_master#".$data->id_asset_master_child;
		?>
		
		<?php
		$vg = EncryptionDB::staticEncryptor("encrypt",$varian_group);
		$url = Url::toRoute(['add-item', 'vg'=>$vg]);
		//echo $url;
		echo Html::button('<i class="fa fa-plus"></i> Tambah Data '.$labelAssetInSide, ['value'=>$url, 'class'=> 'btn btn-sm btn-success modalButton']);
		?>
		
		<?php //echo "Data-data ".$labelAssetInSide ?>
		<div class="box-body table-responsive">
        <?php
		
		
		$config['varian_group'] = $varian_group;
		$searchModel = new AssetItemSearch_Generic($config);
		$searchModel->id_asset_master = $labelAssetInSide = $data->assetMasterChild->id_asset_master;
		$searchModel->id_asset_item_parent = $id_asset_item;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $config);
		$dataProvider->pagination = false;
		
		
		echo $varian_group;
        $listColumnDynamic = AppFieldConfigSearch::getListGridViewWithHeader(AssetItem_Generic::tableName(), $varian_group);


        $coltypeAsset = [
                'label' => 'Jenis Tanaman',
            'attribute' => 'assetItemType3.type_asset_item',
            'filter'=>Html::activeDropDownList($searchModel, 'id_type_asset_item3', $dataListAssetTypeAsetItem3, ['class' => 'form-control']),
        ];
        		$listColumnDynamic = AppFieldConfigSearch::replaceListGridViewItem($listColumnDynamic, 'id_type_asset_item3', $coltypeAsset);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' =>  $listColumnDynamic
        ]); ?>	
		</div>
	</div>

</div>
<?php
}
?>

