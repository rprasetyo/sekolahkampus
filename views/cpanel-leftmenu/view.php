<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CpanelLeftmenu */

$this->title = $model->id_leftmenu;
$this->params['breadcrumbs'][] = ['label' => 'Cpanel Leftmenus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpanel-leftmenu-view box box-primary">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'id' => $model->id_leftmenu], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_leftmenu], [
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
                'id_leftmenu',
                'id_parent_leftmenu',
                'has_child',
                'menu_name',
                'menu_icon',
                'value_indo',
                'value_eng',
                'url:url',
                'is_public',
                'auth:ntext',
                'mobile_display',
                'visible',
            ],
        ]) ?>
    </div>
</div>
