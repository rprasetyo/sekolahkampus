<?php
namespace app\modules\api\controllers;

//use yii\rest\ActiveController;
use app\models\Sensor;
use yii\web\Controller;


class SensorController extends  Controller
{
    public $enableCsrfValidation=false;
//    public $modelClass = 'app\models\AssetItem';

    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $assetItemList = Sensor::find()->all();
        if (count($assetItemList) > 0){
            return array('status'=> true,'data'=> $assetItemList);
        }else{
            return array('status'=> false, 'data'=> 'No AssetItem Found.');
        }
    }

    public function actionCreateSensor()
    {
        \Yii::$app->getResponse()->format= \yii\web\Response::FORMAT_JSON;
//        return array('status'=> true);
        $assetitem = new Sensor();

        $assetitem->scenario=Sensor::SCENARIO_CREATE;
        $assetitem->attributes = \Yii::$app->request->post();

        if ($assetitem->validate()){
            $assetitem->save();
            return array('status' => true, 'data'=>'Sensor Created successfully');
        }else {
            return array('status' => false,'data' => $assetitem->getErrors());
        }


    }

    public function actionListSensor()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $assetItemList = Sensor::find()->all();
        if (count($assetItemList) > 0){
            return array('status'=> true,'data'=> $assetItemList);
        }else{
            return array('status'=> false, 'data'=> 'No AssetItem Found.');
        }
    }

    public function actionGetData(){
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        return array('info' => 'Test GEt Data');
    }

}
