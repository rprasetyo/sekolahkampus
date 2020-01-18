<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AppSetting */

$this->title = 'Detail App Setting';
$this->params['breadcrumbs'][] = ['label' => 'App Setting', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="app-setting-view box box-success">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< Back', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id_app_setting], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_app_setting], [
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
//            'id_app_setting',
            'setting_name',
            [
                'attribute' => 'is_image',
                'value' => function ($model) {
                    return $model->is_image == 0 ? 'False' : 'True';
                },
            ],
            'value',
        ],
    ]) ?>
    </div>
	
	<?php
		if($model->is_image == 1 && $model->value != ""){
			$res = '<img src="' . '../..' . '/web/images/app_setting/' . $model->value . '" class="img-responsive">';
		}else{
			$res = '<small class="label bg-blue">No Have Image</small><Br>';
		}

		echo $res;
	?>
</div>
