<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetMasterLocation */

$this->title = 'Create Asset Master Location';
$this->params['breadcrumbs'][] = ['label' => 'Asset Master Location', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-master-location-create">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
