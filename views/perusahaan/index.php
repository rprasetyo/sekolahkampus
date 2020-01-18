<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PerusahaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perusahaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perusahaan-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Tambah Perusahaan', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//                'id_perusahaan',
//                'security_code',
//                'qrcode_perusahaan',
                'nama_perusahaan',
                'alamat',
                'email1:email',
//                 'email2:email',
                'phone1',
//                 'phone2',
                'media_sosial1',
//                 'media_sosial2',
//                 'media_sosial3',
                [
                    'attribute' => 'status',
                    'label' => 'Status',
                    'value' => 'nameOfStatus'
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
