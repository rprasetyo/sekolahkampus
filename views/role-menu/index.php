<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoleMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Role Menu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-menu-index box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a('Create Role Menu', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'header' => 'No',
                    'class' => 'yii\grid\SerialColumn'
                ],

//                'id_role_menu',
                'menu',
                [
                    'attribute' => 'is_active',
                    'value' => function ($model) {
                        return $model->is_active == 0 ? 'No Active' : 'Active';
                    },
                ],

                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn'
                ],
            ],
        ]); ?>

    </div>
</div>
