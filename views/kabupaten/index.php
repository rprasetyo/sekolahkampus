<?php

use app\models\Propinsi;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KabupatenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey(' Kabupaten');
$this->params['breadcrumbs'][] = $this->title;

$dataProvinsi = ['' => 'Choose'] + ArrayHelper::map(Propinsi::find()->all(), 'id_propinsi', 'nama_propinsi');
?>
<div class="kabupaten-index box box-success">

    <!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-header with-border">
        <p>
            <?= Html::a(CommonActionLabelEnum::CREATE.' '. AppVocabularySearch::getValueByKey('Kabupaten'), ['create'], ['class' => 'btn btn-success']) ?>
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

//                'id_kabupaten',
                [
                    'attribute' => 'provinsi.nama_propinsi',
                    'filter' => Html::activeDropDownList($searchModel, 'id_propinsi', $dataProvinsi, ['class' => 'form-control']),
                ],
                'nama_kabupaten',

                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn'
                ],
            ],
        ]); ?>

    </div>
</div>
