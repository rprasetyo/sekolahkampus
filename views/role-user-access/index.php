<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoleUserAccessSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Role User Accesses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-user-access-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Role User Access', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_role_user_access',
            'id_role_menu',
            'role_name',
            'user_read',
            'user_write',
            //'user_delete',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
