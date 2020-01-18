<?php

namespace app\modules\api\controllers;


use app\modules\api\models\Api;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public $enableCsrfValidation = false;

    public $modelClass = 'app\modules\api\models\Api';

    public function behaviors()

    {

        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [

            'class' => HttpBasicAuth::className(),

            'auth' => function ($username, $password) {

                $user = Api::findByUsername($username);

                if ($user && $user->validatePassword($username, $password)) {

                    return $user;

                }

            }

        ];

        return $behaviors;

    }

}
