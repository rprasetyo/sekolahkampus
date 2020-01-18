<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserPerusahaan */

$this->title = $model->id_user_perusahaan;
$this->params['breadcrumbs'][] = ['label' => 'User Perusahaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-perusahaan-view box box-primary">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'id' => $model->id_user_perusahaan], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_user_perusahaan], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//                'id_user_perusahaan',
                'id_user',
                'id_perusahaan',
                'created_date',
                'created_user',
                'created_ip_address',
            ],
        ]) ?>
    </div>
</div>
