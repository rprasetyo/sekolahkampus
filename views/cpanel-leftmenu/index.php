<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CpanelLeftmenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cpanel Leftmenus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpanel-leftmenu-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Create Cpanel Leftmenu', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id_leftmenu',
                'id_parent_leftmenu',
//                'has_child',
                'menu_name',
                'menu_icon',
                'value_indo',
                'value_eng',
                'url:url',
//                'is_public',
                'auth:ntext',
                'mobile_display',
                'visible',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
