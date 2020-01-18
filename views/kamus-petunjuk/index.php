<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KamusPetunjukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kamus Petunjuk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kamus-petunjuk-index box box-primary">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
    <p>
        <?= Html::a('Create Kamus Petunjuk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>

    <div class="box-body table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id_kamus_petunjuk',
            'nama',
            'deskripsi',
//            'is_visible',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>
