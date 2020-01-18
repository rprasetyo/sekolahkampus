<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Propinsi;
use app\models\Kabupaten;

/* @var $this yii\web\View */
/* @var $model app\models\Sekolah */

$this->title = CommonActionLabelEnum::DETAIL . ' ' . AppVocabularySearch::getValueByKey(' Sekolah');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL . ' ' . AppVocabularySearch::getValueByKey(' Sekolah'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$propinsi = ['' => CommonActionLabelEnum::CHOOSE_PROMPT] + ArrayHelper::map(Propinsi::find()->all(), 'id_propinsi', 'nama_propinsi');
$kabupaten = ['' => CommonActionLabelEnum::CHOOSE_PROMPT] + ArrayHelper::map(Kabupaten::find()->all(), 'id_kabupaten', 'nama_kabupaten');

?>
<style>
    .box {
        border-radius: 8px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1), 0px 10px 20px rgba(0, 0, 0, 0.05), 0px 20px 20px rgba(0, 0, 0, 0.05), 0px 30px 20px rgba(0, 0, 0, 0.05);
    }
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
        background: #7fa998;
        color: #ffffff;
        text-transform: uppercase;
        font-size: 12px;
    }

    table th.last {
        border-right: none;
    }
</style>
<div class="sekolah-view box box-success">

    <div class="box-header with-border">

        <p>
            <?= Html::a('<< ' . CommonActionLabelEnum::BACK, ['index'], ['class' => 'btn btn-warning']) ?>
            <?= Html::a(CommonActionLabelEnum::UPDATE, ['update', 'id' => $model->id_sekolah], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(CommonActionLabelEnum::DELETE, ['delete', 'id' => $model->id_sekolah], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => CommonActionLabelEnum::CONFIRM_DELETE,
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
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
                ],
                [
                    'label' => 'Status Milik',
                    'attribute' => 'statusMilik.status_milik',
                ],
                'alias1',
                'alias2',
                'alias3',
                'alamat1',
                'alamat2',
                'alamat3',
                [
                    'label' => 'Propinsi',
                    'attribute' => 'propinsi.nama_propinsi',
                ],
                [
                    'label' => 'Kabupaten',
                    'attribute' => 'kabupaten.nama_kabupaten',
                ],
                [
                    'label' => 'Website',
                    'attribute' => 'website',
                    'format'=>'raw',
                    'value' => function($data){
                        $url = $data->website;
                        return Html::a($data->website, $url, ['title' => 'Go']);
                    }
                ],
                'medsos1',
                'medsos2',
                'medsos3',
                'medsos4',
                'medsos5',
                'description1:ntext',
                'description2:ntext',
                'description3:ntext',
                'description4:ntext',
                'description5:ntext',
            ],
        ]) ?>
    </div>
</div>
