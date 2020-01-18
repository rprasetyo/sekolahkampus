<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use app\models\TypeAssetItem1;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-item-form">

    <?php //$form = ActiveForm::begin(); ?>


    <?php //= $form->field($model, 'id_asset_master')->textInput() ?>
	
	<?php $dataListAssetItemType = ArrayHelper::map(TypeAssetItem1::find()->asArray()->all(), 'id_type_asset_item', 'type_asset_item');
	echo $form->field($model, 'id_type_asset_item')->dropDownList($dataListAssetItemType,
		['prompt' => '-Pilih Type Asset Item-']);
	?>
	


    

</div>
