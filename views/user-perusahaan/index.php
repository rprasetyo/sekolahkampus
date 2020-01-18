<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserPerusahaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Perusahaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-perusahaan-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Create User Perusahaan', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//                'id_user_perusahaan',
                'id_user',
                'id_perusahaan',
                'created_date',
                'created_user',
                // 'created_ip_address',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
