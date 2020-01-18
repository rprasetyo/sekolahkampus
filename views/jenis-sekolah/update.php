<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenisSekolah */

$this->title = CommonActionLabelEnum::UPDATE.' '. AppVocabularySearch::getValueByKey(' Jenis Sekolah');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey(' Jenis Sekolah'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::DETAIL.' '. AppVocabularySearch::getValueByKey(' Jenis Sekolah'), 'url' => ['view', 'id' => $model->id_jenis_sekolah]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-sekolah-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
