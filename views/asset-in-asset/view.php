<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\common\labeling\CommonActionLabelEnum;
use app\models\AssetItem_Generic;
use app\models\AppFieldConfigSearch;
use app\models\AppVocabularySearch;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem_Generic */

$this->title = CommonActionLabelEnum::DETAIL.' '.AppVocabularySearch::getValueByKey('Inventarisasi Aset');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey('Type Asset 1'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="type-asset1-view box box-success">
    <div class="box-header with-border">

        <p>
            <?= Html::a('<< '.CommonActionLabelEnum::BACK, ['list'], ['class' => 'btn btn-warning']) ?>
            <?= Html::a(CommonActionLabelEnum::UPDATE, ['update', 'id' => $model->id_asset_item], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(CommonActionLabelEnum::DELETE, ['delete', 'id' => $model->id_asset_item], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => CommonActionLabelEnum::CONFIRM_DELETE,
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?php
        $tableName = AssetItem_Generic::tableName(); //Ini yang diganti (Nama tabel dari modelnya)
        $listColumnDynamic = AppFieldConfigSearch::getListDetailView($tableName);

        //CustomColumn
        $colStatus = [
            'attribute' => 'is_active',
            'value' => function ($model) {
                return $model->is_active == 0 ? CommonActionLabelEnum::IN_ACTIVE : CommonActionLabelEnum::ACTIVE;
            },
        ];
        $listColumnDynamic = AppFieldConfigSearch::replaceListGridViewItem($listColumnDynamic, 'is_active', $colStatus);

        echo DetailView::widget([
            'model' => $model,
            'attributes' => $listColumnDynamic,
        ])
        ?>
    </div>
</div>
