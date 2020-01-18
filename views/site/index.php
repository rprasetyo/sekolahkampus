<?php
use yii\helpers\Html;
use app\models\AppSettingSearch;

/* @var $this yii\web\View */

$this->title = Html::encode(Yii::$app->params['appName']);

?>
<style>
    .img-responsive {
        position: relative;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }
</style>
<div class="site-index">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode(Yii::$app->params['appName']) ?> (<?= date('F Y') ?>)
            </h3>
        </div>
        <div class="box-body">
			<?php
			//Get Background Image
			//Ambil Default jika tidak ada
			$imgpath = AppSettingSearch::getValueImageByKey("MAIN-BACKGROUND","images/home.jpg","");
			?>
            <img class="img-responsive" src="<?php echo Yii::$app->request->baseUrl . '/'.$imgpath; ?>"/>

        </div>
    </div>

</div>
