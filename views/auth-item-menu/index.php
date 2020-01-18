<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthItemMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auth Item Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Auth Item Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_auth_item_menu',
            'menu_utama',
            'child_menu',
            'role',
            'path',
            //'is_enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
