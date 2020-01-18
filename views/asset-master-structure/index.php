<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AssetMaster;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssetMasterStructureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = CommonActionLabelEnum::LIST_ALL . ' Asset Master Structure';
$this->params['breadcrumbs'][] = $this->title;

$dataAssetMaster = ['' => 'Pilih'] + ArrayHelper::map(AssetMaster::find()->all(), 'id_asset_master', 'asset_name');
?>
<div class="asset-master-structure-index box box-success">

    <!-- <h1><?php Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a(CommonActionLabelEnum::CREATE . ' Asset Master Structure', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ],
                [
                    'label' => 'Asset Master Parent',
                    'attribute' => 'assetMasterParent.asset_name',
                    'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'id_asset_master_parent',
                        'data' => $dataAssetMaster,
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'hideSearch' => false,

                    ]),
                ],
                [
                    'label' => 'Asset Master Child',
                    'attribute' => 'assetMasterChild.asset_name',
                    'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'id_asset_master_child',
                        'data' => $dataAssetMaster,
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'hideSearch' => false,

                    ]),
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                ],
            ],
        ]); ?>

    </div>
</div>