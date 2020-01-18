<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AppFieldConfig */

$this->title = 'Detail App Field Config';
$this->params['breadcrumbs'][] = ['label' => 'App Field Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="app-field-config-view box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< Back', ['index'], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id_app_field_config], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_app_field_config], [
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
//            'id_app_field_config',
                'classname',
                'fieldname',
                'label',
                'no_order',
                [
                    'attribute' => 'is_visible',
                    'value' => function ($model) {
                        return $model->is_visible == 0 ? 'False' : 'True';
                    }
                ],
                [
                    'attribute' => 'is_required',
                    'value' => function ($model) {
                        return $model->is_required == 0 ? 'False' : 'True';
                    }
                ],
                [
                    'attribute' => 'is_unique',
                    'value' => function ($model) {
                        return $model->is_unique == 0 ? 'Tidak' : 'Ya';
                    }
                ],
                [
                    'attribute' => 'is_safe',
                    'value' => function ($model) {
                        return $model->is_safe == 0 ? 'Tidak' : 'Ya';
                    }
                ],
                'type_field',
                'max_field',
                'default_value',
                'pattern',
                'image_extensions',
                'image_max_size',
            ],
        ]) ?>
    </div>
</div>
