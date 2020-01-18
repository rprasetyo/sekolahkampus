<?php

use app\common\labeling\CommonActionLabelEnum;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = CommonActionLabelEnum::LIST_ALL . ' Auth Menu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-menu-index box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a(CommonActionLabelEnum::CREATE . ' Auth Menu', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'header' => 'No',
                    'class' => 'yii\grid\SerialColumn'],

                'menu_utama',
                'child_menu',
                'path',

                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
