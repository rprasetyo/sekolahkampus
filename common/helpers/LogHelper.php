<?php
namespace app\common\helpers;

use Yii;
use yii\base\Component;

class LogHelper extends Component{	
	public static function setPublicSubmitted($model){
        $model->userid = Yii::$app->user->identity->id;
		$model->request_date = Timeanddate::getCurrentDateTime();
		$model->request_time = Timeanddate::getCurrentDate();
        $model->request_ip_address = IPAddressFunction::getUserIPAddress();
		
		$model->save(false);
	}
	
	public static function setAssesmentLog($model){
		$model->assesment_id_user = Yii::$app->user->identity->id;
		$model->assesment_ip_address = IPAddressFunction::getUserIPAddress();
		$model->assesment_date = Timeanddate::getCurrentDate();
		$model->assesment_time = Timeanddate::getCurrentDateTime();
		
		$model->save(false);
	}

    public static function setPublicUploaded($model){
        $model->uploaded_user_id = Yii::$app->user->identity->id;
        $model->upload_date = Timeanddate::getCurrentDateTime();
        $model->uploaded_ip_address = IPAddressFunction::getUserIPAddress();

        $model->save(false);
    }

}
?>
