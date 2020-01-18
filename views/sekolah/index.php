<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use app\models\JenisSekolah;
use app\models\StatusMilik;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SekolahSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = CommonActionLabelEnum::LIST_ALL . ' ' . AppVocabularySearch::getValueByKey(' Sekolah');
$this->params['breadcrumbs'][] = $this->title;

$jenis_sekolah = ['' => CommonActionLabelEnum::CHOOSE_PROMPT] + ArrayHelper::map(JenisSekolah::find()->all(), 'id_jenis_sekolah', 'jenis_sekolah');
$statusMilik = ['' => CommonActionLabelEnum::CHOOSE_PROMPT] + ArrayHelper::map(StatusMilik::find()->all(), 'id_status_milik', 'status_milik');

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
<div class="sekolah-index box box-primary">

    <div class="box-header with-border">
        <p>
            <?= Html::a(CommonActionLabelEnum::CREATE . ' ' . AppVocabularySearch::getValueByKey('Sekolah'), ['create'], ['class' => 'btn bg-olive']) ?>
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
                    'label' => 'Nama Sekolah',
                    'attribute' => 'nama_sekolah',
                ],
                [
                    'label' => 'Nama Sekolah Singkat',
                    'attribute' => 'nama_sekolah_singkat',
                ],
//                'alias1',
//                'alias2',
                //'alias3',
                [
                    'label' => 'Jenis Sekolah',
                    'attribute' => 'jenisSekolah.jenis_sekolah',
                    'filter' => Html::activeDropDownList($searchModel, 'id_jenis_sekolah', $jenis_sekolah, ['class' => 'form-control']),
                ],
                [
                    'label' => 'Status Milik',
                    'attribute' => 'statusMilik.status_milik',
                    'filter' => Html::activeDropDownList($searchModel, 'id_status_milik', $statusMilik, ['class' => 'form-control']),
                ],
                //'id_jenis_sekolah',
                //'id_status_milik',
                //'alamat1',
                //'alamat2',
                //'alamat3',
                //'id_kabupaten',
                //'id_propinsi',
                //'website',
                //'medsos1',
                //'medsos2',
                //'medsos3',
                //'medsos4',
                //'medsos5',
                //'description1:ntext',
                //'description2:ntext',
                //'description3:ntext',
                //'description4:ntext',
                //'description5:ntext',

                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn'
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
