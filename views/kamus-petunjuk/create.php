<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KamusPetunjuk */

$this->title = 'Create Kamus Petunjuk';
$this->params['breadcrumbs'][] = ['label' => 'Kamus Petunjuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kamus-petunjuk-create">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
