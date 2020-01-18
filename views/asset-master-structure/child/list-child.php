<?php
use yii\grid\GridView;
use yii\helpers\Html;

?>

<!--<div class="asset-master-structure-index box">-->
    <div class="box-body table-responsive table-bordered">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
            'layout' => '{items}{pager}',
            'columns' => [
                [
                    'header' => 'No',
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['style' => 'width:440px; white-space: normal;']
                ],

                // 'id_asset_master_structure',
                [
                    'label' => 'Asset Master Child',
                    'attribute' => 'assetMasterChild.asset_name',
//                    'contentOptions' => ['class' => 'text-center'],
//                    'headerOptions' => ['class' => 'text-center']
                    // 'contentOptions' => ['style' => 'width:1000px; white-space: normal;'],
                ],
            ],
        ]); ?>
    </div>
<!--</div>-->