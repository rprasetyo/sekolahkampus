<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StatusMilik */

$this->title = CommonActionLabelEnum::CREATE.' '. AppVocabularySearch::getValueByKey(' Status Milik');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey(' Status Milik'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-milik-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
