<?php

use app\common\utils\EncryptionDB;
use app\models\AssetItemLocation;
use app\models\AssetMaster;
use app\models\AssetReceived;
use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use app\models\TypeAssetItem1;
use app\models\TypeAssetItem2;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Map Maker - Polygon';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$models = $dataProviderDisplay->getModels();
?>
<div class="asset-item-list box box-success">
	<div class="row">
		<div class="col-md-9">
			<div class="box-body" style="">
				<?= $this->render('_map_multiple', [
					'models' => $models,
				]) ?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="box-body" style="">
				Ini Nanti Buat Panelnya
			</div>
		</div>
	</div>
</div>