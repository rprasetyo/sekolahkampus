<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AppSettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Setting Aplikasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-setting-index box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php /*
    <div class="box-header with-border">
        <p>
            <?= Html::a('Create App Setting', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
	*/ ?>

    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                [
                    'header' => 'No',
                    'class' => 'yii\grid\SerialColumn'
                ],

//                'id_app_setting',
                'setting_name',
				/*
                [
                    'attribute' => 'is_image',
                    'value' => function ($model) {
                        return $model->is_image == 0 ? 'False' : 'True';
                    },
                ],
				*/
                'value',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{upload-image}',
                    'header' => 'Image',// the default buttons + your custom button
                    'contentOptions' => ['style' => 'width: 180px;'],
                    'buttons' => [
                        'upload-image' => function($url, $model, $key) {
                            if($model->is_image == 1 && $model->value != ""){
                                $res = '<img src="' . '../..' . '/web/images/app_setting/' . $model->value . '" class="img-responsive">';
                            }else{
                                $res = '<small class="label bg-blue">No Have Image</small><Br>';
                            }

                            return $res;
                        }
                    ]
                ],
                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update}'
                ],
            ],
        ]); ?>
    </div>
</div>
