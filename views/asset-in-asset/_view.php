<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\common\labeling\CommonActionLabelEnum;
use app\models\AssetItem_Generic;
use app\models\AppFieldConfigSearch;
use app\models\AppVocabularySearch;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem_Generic */

\yii\web\YiiAsset::register($this);
?>

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

