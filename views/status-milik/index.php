<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatusMilikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = CommonActionLabelEnum::LIST_ALL . ' ' . AppVocabularySearch::getValueByKey(' Status Milik');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    table {
        margin: 25px auto;
        border-collapse: collapse;
        border: 1px solid #eee;
        border-bottom: 2px solid #00cccc;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1), 0px 10px 20px rgba(0, 0, 0, 0.05), 0px 20px 20px rgba(0, 0, 0, 0.05), 0px 30px 20px rgba(0, 0, 0, 0.05);
    }

    table tr:hover {
        background: #f4f4f4;
    }

    table tr:hover td {
        color: #555;
    }

    table th, table td {
        color: #999;
        border: 1px solid #eee;
        padding: 12px 35px;
        border-collapse: collapse;
    }

    table th {
        background: #FFEB3B;
        color: #3c8dbc;
        text-transform: uppercase;
        font-size: 12px;
    }

    table th.last {
        border-right: none;
    }
</style>

<div class="status-milik-index box box-primary">
    <div class="box-header with-border">
        <p>
            <?= Html::a(CommonActionLabelEnum::CREATE . ' ' . AppVocabularySearch::getValueByKey('Status Milik'), ['create'], ['class' => 'btn bg-olive']) ?>
        </p>
    </div>

    <div class="box-body table-responsive">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'showOnEmpty' => true,
            'tableOptions' => [
                'class' => 'table table-hover '
            ],
            'columns' => [
                [
                    'header' => 'No',
                    'class' => 'yii\grid\SerialColumn'
                ],
                [
                    'label' => 'Status Milik',
                    'attribute' => 'status_milik',
                ],
                [
                    'label' => 'Keterangan',
                    'attribute' => 'keterangan',
                ],
                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn'
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
