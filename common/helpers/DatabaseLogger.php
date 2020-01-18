<?php

namespace app\common\helpers;

use Yii;
use yii\base\Component;
use app\common\helpers\Timeanddate;
use app\common\helpers\IPAddressFunction;

class DatabaseLogger extends Component {

    public static function setWriteUserKontak($model)
    {
		$model->inputdate = Timeanddate::getCurrentDateTime();
		$model->userid = IPAddressFunction::getUserIPAddress(); //Sementara karena tidak punya tempat ditaruh dulu di userid
		//echo $model->inputdate." ".$model->userid;
		return $model;
    }

}
