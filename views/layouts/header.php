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
            <a href="<?= Yii::$app->homeUrl ?>" class="navbar-brand"><i class="fa fa-building"></i>&nbsp;<?= $appName?></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= Yii::$app->homeUrl ?>">Home</a></li>
                <li><?= Html::a(
                        'Sekolah',
                        ['/sekolah'],
                        ['data-method' => 'post']
                    ) ?></li>
                <li><?= Html::a(
                        'Jenis Sekolah',
                        ['/jenis-sekolah'],
                        ['data-method' => 'post']
                    ) ?></li> <li><?= Html::a(
                        'Status Milik',
                        ['/status-milik'],
                        ['data-method' => 'post']
                    ) ?></li>
            </ul>

        </div>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                        <span class="hidden-xs"><?= Yii::$app->user->isGuest ? ('Guest') :
                                (Yii::$app->user->identity->full_name) ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                <?= Yii::$app->user->isGuest ? ('Guest') : (Yii::$app->user->identity->full_name) ?>
                                <small><?= Yii::$app->user->isGuest ? ('Guest') : (Yii::$app->user->identity->email) ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
