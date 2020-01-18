<?php

use yii\helpers\Html;
use app\models\AppVocabularySearch;
use app\common\labeling\CommonActionLabelEnum;

/* @var $this yii\web\View */
/* @var $model app\models\TypeAsset1 */

$this->title = CommonActionLabelEnum::UPDATE.' '. AppVocabularySearch::getValueByKey('Inventarisasi Aset');
//$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST.' '. AppVocabularySearch::getValueByKey('Type Asset 1'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::DETAIL.' '. AppVocabularySearch::getValueByKey('Type Asset 1'), 'url' => ['view', 'id' => $model->id_type_asset]];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-asset1-update">

    <?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
