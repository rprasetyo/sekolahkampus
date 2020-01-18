<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\ChangePassword;
use app\models\MobileSession;
use app\models\Sensor;
use app\models\SensorLog;
use app\models\SensorSearch;
use app\models\ProductMarketplace;
use app\models\ProductMarketplaceSearch;
use app\common\utils\EncryptionDB;
use app\common\helpers\FormatString;
use app\common\helpers\Timeanddate;

/**
 * Default controller for the `api` module
 */
class SensorController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'sign-up' => ['POST'],
                    'login' => ['POST'],
                    'check-session' => ['GET'],
                    'logout' => ['POST'],
                    'change-password' => ['POST'],
                    'list-student' => ['GET', 'HEAD'],
                    'update-student' => ['PUT', 'PATCH'],
                    'delete-student' => ['DELETE'],
                    'view-student' => ['GET', 'HEAD'],
                ],
            ],
        ];
    }

	
	public function actionSetValue(){
		\Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

		

		$postData = \yii::$app->request->post();
		if(isset($postData['im'])){
			$imei = $postData['im'];
		}else{
			$imei = "==";
		}
		
		if(isset($postData['c'])){
			$cid = $postData['c'];
		}else{
			$cid = "==";
		}
		
		if(isset($_POST['im'])){
			$imei = $_POST['im'];
		}
		if(isset($_POST['c'])){
			$cid = $_POST['c'];
		}
		
		$sa = Sensor::find()
			->where(['imei' => $imei, 'cid'=>$cid])
			->one();
		if($sa != null){
			$x=10;
			for($i=1;$i<=$x;$i++){
				if(isset($postData['A'.$i])){
					$field  = "sensor_analog".$i;
					
					$val = $postData['A'.$i];
					$sa->$field= $val;
				}
			}
			$sa->last_update = Timeanddate::getCurrentDateTime();
			$sa->save(false);
			
			//Insert Log History
			$history = new SensorLog;
			$history->id_sensor = $sa->id_sensor;
			$history->log_time = Timeanddate::getCurrentDateTime();
			$history->log_date = Timeanddate::getCurrentDate();
			for($i=1;$i<=$x;$i++){
				if(isset($postData['A'.$i])){
					$field  = "value".$i;
					
					$val = $postData['A'.$i];
					$history->$field= $val;
				}
			}
			$history->save(false);
			
			return array('status'=>true,
				'name' => $sa->sensor_name, 
				'last_update' => $sa->last_update

			);
		}else{
			return array('status' => false, 'name' => 'Unknown device');
		}
	}

    protected function findModelSensor($id) {
        if (($model = Sensor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Data Sensor does not exist.');
    }

}
