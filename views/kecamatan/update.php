<?php

use yii\helpers\Html;
use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;

/* @var $this yii\web\View */
/* @var $model app\models\Kecamatan */

$this->title = CommonActionLabelEnum::UPDATE.' '. AppVocabularySearch::getValueByKey(' Kecamatan');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey(' Kecamatan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::DETAIL.' '. AppVocabularySearch::getValueByKey(' Kecamatan'), 'url' => ['view', 'id' => $model->id_kecamatan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kecamatan-update">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
