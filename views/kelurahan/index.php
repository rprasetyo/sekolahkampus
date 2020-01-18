<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use app\models\AppFieldConfigSearch;
use app\models\Kecamatan;
use app\models\Kelurahan;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KelurahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey(' Kelurahan');
$this->params['breadcrumbs'][] = $this->title;

$dataKecamtan = ['' => 'Pilih'] + ArrayHelper::map(Kecamatan::find()->all(), 'id_kecamatan', 'nama_kecamatan');
?>
<div class="kelurahan-index box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a(CommonActionLabelEnum::CREATE.' '. AppVocabularySearch::getValueByKey('Kelurahan'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="box-body table-responsive">
        <?php
        $listColumnDynamic = AppFieldConfigSearch::getListGridView(Kelurahan::tableName());

        $colKecamatan = [
            'attribute' => 'kecamatan.nama_kecamatan',
            'filter' => Html::activeDropDownList($searchModel, 'id_kecamatan', $dataKecamtan, ['class' => 'form-control']),
        ];
        $listColumnDynamic = AppFieldConfigSearch::replaceListGridViewItem($listColumnDynamic, 'id_kecamatan', $colKecamatan);


        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $listColumnDynamic
        ]); ?>

    </div>
</div>
