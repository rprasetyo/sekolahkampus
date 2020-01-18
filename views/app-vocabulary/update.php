<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppVocabulary */

$this->title = 'Update App Vocabulary';
$this->params['breadcrumbs'][] = ['label' => 'App Vocabulary', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail App Vocabulary', 'url' => ['view', 'id' => $model->id_app_vocabulary]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="app-vocabulary-update">

<!--    <h1>--><?php //Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
