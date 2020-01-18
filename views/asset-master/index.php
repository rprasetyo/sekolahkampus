<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\TypeAsset1;
use app\models\AppFieldConfigSearch;
use app\models\AssetMaster;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssetMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey(' Asset Master');
$this->params['breadcrumbs'][] = $this->title;

$dataList1 = ['' => 'Choose'] + ArrayHelper::map(TypeAsset1::find()->all(), 'id_type_asset', 'type_asset');
?>
<div class="asset-master-index box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a(CommonActionLabelEnum::CREATE.' '. AppVocabularySearch::getValueByKey(' Asset Master'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>	
	
    <div class="box-body table-responsive">
        <?php 
		$listColumnDynamic = AppFieldConfigSearch::getListGridView(AssetMaster::tableName());
		
		//CustomColumn
		$coltypeAsset = [
		        'label' => 'Type',
			'attribute' => 'typeAsset1.type_asset',
			'filter'=>Html::activeDropDownList($searchModel, 'id_type_asset1', $dataList1, ['class' => 'form-control']),
		];		
		$listColumnDynamic = AppFieldConfigSearch::replaceListGridViewItem($listColumnDynamic, 'id_type_asset1', $coltypeAsset);
		
		//echo var_export($listColumnDynamic, true); exit();
		
		echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $listColumnDynamic,
        ]); ?>

    </div>
	
	<?php /*
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//            'id_asset_master',
                'asset_name',
//                'id_asset_code',
                'asset_code',
                [
                    'attribute' => 'typeAsset1.type_asset',
                    'filter'=>Html::activeDropDownList($searchModel, 'id_type_asset1', $dataList1, ['class' => 'form-control']),
                ],
                //'id_type_asset2',
                //'id_type_asset3',
                //'id_type_asset4',
                //'id_type_asset5',
                //'attribute1',
                //'attribute2',
                //'attribute3',
                //'attribute4',
                //'attribute5',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
	*/ ?>
</div>
