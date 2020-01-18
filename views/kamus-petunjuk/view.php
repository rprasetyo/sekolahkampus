<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\KamusPetunjuk */

$this->title = 'Detail Kamus Petunjuk';
$this->params['breadcrumbs'][] = ['label' => 'Kamus Petunjuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kamus-petunjuk-view box box-primary">

    <div class="box-body">
<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_kamus_petunjuk], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_kamus_petunjuk], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id_kamus_petunjuk',
            'nama',
            'deskripsi',
//            'is_visible',
            [
                'attribute' => 'is_visible',
                'value' => function ($model) {
                    return $model->is_visible == 0 ? 'Tidak' : 'Ya';
                },
                'filter' => [
                    1 => 'Ya',
                    0 => 'Tidak'
                ]
            ],
        ],
    ]) ?>

    </div>
</div>
