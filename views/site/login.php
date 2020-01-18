<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\AppSettingSearch;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<?php
$background_imgpath = AppSettingSearch::getValueImageByKey("MAIN-BACKGROUND","images/home.jpg", "");
?>
<style>
.bg-img {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-image: url(../<?= $background_imgpath ?>);
    background-size: cover;
}
</style>
<div class="login-box">
    <div class="login-logo">
<!--        <h3 ><strong>PLEASE LOGIN</strong></H3>-->
        <!-- <? //=  Html::a('<span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?> -->
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body" style="background-color: rgba(192, 192, 192, 0.8)">
		<?php
			//Get Logo
			//Ambil Default jika tidak ada
			$imgpath = AppSettingSearch::getValueImageByKey("Logo","/web/images/logo.png");
		?>
        <p class="login-box-msg"><?php 
		echo Html::img('@'.$imgpath, ['class' => 'img-square', 'height' => 60]);
		//echo Html::img('@web/images/logo.png', ['class' => 'img-square', 'height' => 60]) 
		?></p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-xs-8">
<!--                --><?php // $form->field($model, 'rememberMe')->checkbox() ?>
<!--                --><?php // Html::a('forgot your password ?', ['#']) ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-success btn-block btn-sm', 'style' => 'border-radius: 40px', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

        <!--        <div class="social-auth-links text-center">-->
        <!--            <p>- OR -</p>-->
        <!--            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in-->
        <!--                using Facebook</a>-->
        <!--            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign-->
        <!--                in using Google+</a>-->
        <!--        </div>-->
        <!-- /.social-auth-links -->

        <!--        <a href="#">I forgot my password</a><br>-->
        <!--        <a href="register.html" class="text-center">Register a new membership</a>-->

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
