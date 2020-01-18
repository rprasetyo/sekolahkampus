<?php

use app\common\labeling\CommonActionLabelEnum;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterStructure */

$this->title = CommonActionLabelEnum::CREATE.' Asset Master Structure';
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL.' Asset Master Structures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-master-structure-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
