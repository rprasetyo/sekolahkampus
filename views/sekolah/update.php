<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sekolah */

$this->title = CommonActionLabelEnum::UPDATE.' '. AppVocabularySearch::getValueByKey(' Sekolah');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey(' Sekolah'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::DETAIL.' '. AppVocabularySearch::getValueByKey(' Sekolah'), 'url' => ['view', 'id' => $model->id_sekolah]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sekolah-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
