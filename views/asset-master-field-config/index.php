<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssetMasterFieldConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Master Field Config';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-master-field-config-index box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a('Create Asset Master Field Config', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'header' => 'No',
                    'class' => 'yii\grid\SerialColumn'
                ],

//            'id_asset_master_field_config',
                'fieldname',
                'label',
                [
                    'attribute' => 'is_visible',
                    'value' => function ($model) {
                        return $model->is_visible == 0 ? 'False' : 'True';
                    },
                ],
                [
                    'attribute' => 'is_required',
                    'value' => function ($model) {
                        return $model->is_required == 0 ? 'False' : 'True';
                    },
                ],
                //'type_field',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
</div>
