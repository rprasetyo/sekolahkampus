<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use app\common\utils\EncryptionDB;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = AppVocabularySearch::getValueByKey('Role');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index box box-primary">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="box-header with-border">
		<p>
			<?= Html::a(CommonActionLabelEnum::CREATE.' '. AppVocabularySearch::getValueByKey('Role'), ['create-role'], ['class' => 'btn btn-success']) ?>
		</p>
	</div>
	<div class="box-body table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            //'type',
            'description:ntext',
            'rule_name',
            //'data',
            'created_at',
            //'updated_at',
			['class' => 'yii\grid\ActionColumn',
				'template' => ' {status-action}',  // the default buttons + your custom button
				'header' => 'Detail',
				'buttons' => [
					'status-action' => function ($url, $model, $key) {     // render your custom button
						//$ic = EncryptionDB::encryptor('encrypt', $model->id_asset_item);
						$urlpeta = Url::toRoute(['/auth-item/view-detail-role', 'c' => $model->name]);
						return Html::a('Detail', $urlpeta, ['class' => 'btn btn-sm btn-danger']);
					}
			]],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	</div>
</div>
