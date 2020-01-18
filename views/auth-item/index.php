<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Auth Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index box box-primary">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="box-header with-border">
		<p>
			<?= Html::a('Create Auth Item', ['create'], ['class' => 'btn btn-success']) ?>
		</p>
	</div>
	<div class="box-body table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'type',
            'description:ntext',
            'rule_name',
            //'data',
            'created_at',
            //'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	</div>
</div>
