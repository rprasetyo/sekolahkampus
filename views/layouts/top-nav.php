<?php

use yii\helpers\Html;
use app\models\AppSettingSearch;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php
	$appName = AppSettingSearch::getValueByKey("APP-NAME-SINGKAT", Yii::$app->params['appName']);
	$appNameShort = AppSettingSearch::getValueByKey("APP-NAME-SINGKATAN", Yii::$app->params['appNameShort']);
?>
<header class="main-header bg-g">

    <?php //= Html::a('<span class="logo-mini"><b>'.Html::encode(Yii::$app->params['appNameShort']).'</b></span><span class="logo-lg">' .Html::encode(Yii::$app->params['appName']). '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <nav class="navbar navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a href="<?= \yii\helpers\Url::toRoute('/public') ?>" class="navbar-brand"><i class="fa fa-building"></i>&nbsp;<?= $appName?></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= \yii\helpers\Url::toRoute('/public') ?>">Daftar Sekolah</a></li>
            </ul>

        </div>

    </nav>
</header>
