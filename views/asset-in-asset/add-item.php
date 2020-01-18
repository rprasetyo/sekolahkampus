<?php

use yii\helpers\Html;
use app\models\AppFieldConfigSearch;
use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;

/* @var $this yii\web\View */
/* @var $model app\models\TypeAsset1 */

$this->title = CommonActionLabelEnum::CREATE.' '. AppVocabularySearch::getValueByKey('Inventarisasi Aset');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL.' '. AppVocabularySearch::getValueByKey('Inventarisasi Aset'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-asset1-create">

    <?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form-add-item', [
        'model' => $model,
		'varian_group' =>$varian_group
    ]) ?>

</div>
