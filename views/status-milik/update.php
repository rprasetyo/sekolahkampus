<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;

/* @var $this yii\web\View */
/* @var $model app\models\StatusMilik */

$this->title = CommonActionLabelEnum::UPDATE . ' ' . AppVocabularySearch::getValueByKey(' Status Milik');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL . ' ' . AppVocabularySearch::getValueByKey(' Status Milik'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::DETAIL . ' ' . AppVocabularySearch::getValueByKey(' Status Milik'), 'url' => ['view', 'id' => $model->id_status_milik]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-milik-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
