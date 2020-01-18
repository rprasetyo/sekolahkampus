<?php

namespace app\modules\api\controllers;

use app\modules\api\models\ChangePassword;
use app\modules\api\models\LoginForm;
use app\modules\api\models\MobileSession;
use app\modules\api\models\SignupForm;
use Yii;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;

class UserController extends Controller
{
    public $enableCsrfValidation=false;
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

    public function actionIndex() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        return array('info' => 'Flutter Project API');
    }

    public function actionGetToken(){
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $postData = \yii::$app->request->post();
        if(isset($postData['auth_key'])){
            $imei = $postData['im'];
        }else{
            $imei = "";
        }

        if(isset($postData['auth_key'])){
            $cid = $postData['c'];
        }else{
            $cid = "";
        }

        $token = rand(100000000,900000000);


        return array('token' => $token);
    }

    private function getApplicationMobileToken() {
        return 'asfafasfdsajeej89sadfasjfbwasfsagipPajjqwidbQBiadq';
    }

    public function actionPostData(){
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $postData = \yii::$app->request->post();
        if(isset($postData['im'])){
            $imei = $postData['im'];
        }else{
            $imei = "==";
        }

        return array('im' => $imei);
    }

    public function actionCheckAccessMain($headers) {
        if ($headers['app_mobile_token'] != $this->getApplicationMobileToken()) {
            throw new ForbiddenHttpException('Application Mobile Token Not Valid');
        }
    }

    public function actionSignUp() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessMain(yii::$app->request->headers);

        try {
            $signupForm = new SignupForm();
            $signupForm->attributes = \yii::$app->request->post();
            if ($signupForm->validate()) {
                $user = $signupForm->signup();
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success signup', 'data' => $user);
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'failed signup', 'data' => $signupForm->getErrors());
            }
        } catch (\Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    public function actionLogin() {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessMain(yii::$app->request->headers);
        try {
            $model = new LoginForm(['scenario' => 'apiLoginScenario']);
            $model->attributes = \yii::$app->request->post();
            if ($model->validate()) {
              $user = $model->apiLogin();
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success login', 'data' => $user);
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'failed login', 'data' => $model->getErrors());
            }
        } catch (\Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    public function actionLogout() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessMain(yii::$app->request->headers);
        try {
            $postData = \yii::$app->request->post();
            $auth_key = (isset($postData['auth_key'])) ? $postData['auth_key'] : '';
            if ($auth_key != '') {
                $this->deleteSessionMobile($auth_key);
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success logout', 'data' => array());
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'failed logout', 'data' => array());
            }
        } catch (\Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    private function deleteSessionMobile($auth_key) {
        MobileSession::updateAll(['status' => 0], ['=', 'auth_key', $auth_key]);
    }

    public function actionChangePassword() {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessMain(yii::$app->request->headers);


        try {
            $model = new ChangePassword(['scenario' => 'apiChangePasswordScenario']);
            $model->attributes = \yii::$app->request->post();
            if ($model->validate()) {
                $user = $model->changePassword();
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'success change password', 'data' => $user);
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'failed change password', 'data' => $model->getErrors());
            }
        } catch (\Exception $e) {
            //echo 'Message: ' . $e->getMessage();
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    public function actionCheckSession() {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $headers = yii::$app->request->headers;
        $this->actionCheckAccessMain($headers);
        $user_mobile_token = $headers['user_mobile_token'];
        $session = MobileSession::find()->select([
            "auth_key"
        ])
            ->where("auth_key = '" . $user_mobile_token . "' AND status = 1 AND valid_date_time >= NOW()")
            ->asArray()
            ->one();
        try {
            if ($session) {
                return array('status' => true, 'code' => Yii::$app->response->statusCode, 'message' => 'User Token Valid', 'data' => array());
            } else {
                return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => 'User Mobile Token Not Validd', 'data' => array());
            }
        } catch (\Exception $e) {
            return array('status' => false, 'code' => Yii::$app->response->statusCode, 'message' => $e->getMessage(), 'data' => array());
        }
    }

    public function actionCheckAccessRequest($headers) {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $this->actionCheckAccessMain($headers);

        $user_mobile_token = $headers['user_mobile_token'];
        $session = MobileSession::find()->select([
            "auth_key"
        ])
            ->where("auth_key = '" . $user_mobile_token . "' AND status = 1 AND valid_date_time >= NOW()")
            ->asArray()
            ->one();

        if (!$session) {
            throw new ForbiddenHttpException('User Mobile Token Not Valid, maybe is expired, please login again');
        }
    }

}
