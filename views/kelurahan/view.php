<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Kelurahan;
use app\models\AppFieldConfigSearch;
use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;

/* @var $this yii\web\View */
/* @var $model app\models\Kelurahan */

$this->title = CommonActionLabelEnum::DETAIL.' '. AppVocabularySearch::getValueByKey(' Kelurahan');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey(' Kelurahan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kelurahan-view box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< '.CommonActionLabelEnum::BACK, ['index'], ['class' => 'btn btn-warning']) ?>
            <?= Html::a(CommonActionLabelEnum::UPDATE, ['update', 'id' => $model->id_kelurahan], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(CommonActionLabelEnum::DELETE, ['delete', 'id' => $model->id_kelurahan], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => CommonActionLabelEnum::CONFIRM_DELETE,
                    'method' => 'post',
                ],
            ]) ?>
        </p>

		<?php /*
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//                'id_kelurahan',
                'kecamatan.nama_kecamatan',
                'nama_kelurahan',
                'kodepos',
            ],
        ]) ?>
		*/ ?>
		
		<?php
		$tableName = Kelurahan::tableName(); //Ini yang diganti (Nama tabel dari modelnya)
		$listColumnDynamic = AppFieldConfigSearch::getListDetailView($tableName);
		
		//CustomColumn
		$coltypeAsset = [
			'attribute' => 'kecamatan.nama_kecamatan',
		];		
		$listColumnDynamic = AppFieldConfigSearch::replaceListGridViewItem($listColumnDynamic, 'id_kecamatan', $coltypeAsset);
		
		echo DetailView::widget([
            'model' => $model,
            'attributes' => $listColumnDynamic,
        ]) 
		?>
    </div>
</div>
