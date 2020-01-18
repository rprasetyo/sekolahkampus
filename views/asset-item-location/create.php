<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItemLocation */

$this->title = 'Create Asset Item Location';
$this->params['breadcrumbs'][] = ['label' => 'Asset Item Location', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-item-location-create">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
