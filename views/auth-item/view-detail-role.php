<?php

use dosamigos\grid\columns\EditableColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthItemMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auth Item Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-menu-index box box-primary">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="box-header with-border">
    <p>
        <?= Html::a('Create Auth Item Menu', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Generate Auth Menu', ['generate-auth-menu','c'=> $searchModel->role], ['class' => 'btn btn-primary']) ?>
    </p>
	</div>
	<div class="box-body table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_auth_item_menu',
            'menu_utama',
            'child_menu',
//            'role',
            [
                'class' => EditableColumn::className(),
                'attribute' => 'role',
                'url' => ['editable'], // the route to the editable action!
                'type' => 'text',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'text-color : white', 'class' => 'text-left text-blue'];
                },
                'editableOptions' => [
                    'mode' => 'popup',
                ]
            ],
//            'path',
            [
                'class' => EditableColumn::className(),
                'attribute' => 'path',
                'url' => ['editable'], // the route to the editable action!
                'type' => 'text',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'text-color : white', 'class' => 'text-left text-blue'];
                },
                'editableOptions' => [
                    'mode' => 'popup',
                ]
            ],
//            'is_enable',
            [
                'class' => EditableColumn::className(),
                'attribute' => 'is_enable',
                'value' => function ($model) {
                    return $model->is_enable == 0 ? 'false' : 'true';
                },
                'url' => ['editable'], // the route to the editable action!
                'type' => 'select',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style' => 'text-color : white', 'class' => 'text-center text-blue'];
                },
                'editableOptions' => [
                    'mode' => 'popup',
                    'source' => json_encode(
                        [
                            [
                                'value' => '1',
                                'text' => 'true',
                            ],
                            [
                                'value' => '0',
                                'text' => 'false',
                            ]
                        ]
                    ),
                ]
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	</div>
</div>
