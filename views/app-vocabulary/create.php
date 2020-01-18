<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppVocabulary */

$this->title = 'TAmbah App Vocabulary';
$this->params['breadcrumbs'][] = ['label' => 'App Vocabulary', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-vocabulary-create">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
