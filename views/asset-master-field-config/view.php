<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterFieldConfig */

$this->title = 'Detail Asset Master Field Config';
$this->params['breadcrumbs'][] = ['label' => 'Asset Master Field Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-master-field-config-view box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< Back', ['index'], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id_asset_master_field_config], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_asset_master_field_config], [
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
                'type_field',
            ],
        ]) ?>

    </div>
</div>
