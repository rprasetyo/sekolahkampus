<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssetCode */

$this->title = 'Create Asset Code';
$this->params['breadcrumbs'][] = ['label' => 'Asset Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
