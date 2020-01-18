<?php


namespace app\modules\api\controllers;


use app\models\User;
use yii\rest\ActiveController;

class AuthController extends ActiveController
{
    public $modelClass = 'app\models\User';
//    public $serializer = [
//        'class' => '\Yii\rest\Serializer',
//        'collectionEnvelope' => 'data',
//    ];

    public function actionToken()
    {

        $access_token = null;

        $message = array();

        if (\Yii::$app->request->post()) {

            if (!\Yii::$app->user->identity || !\Yii::$app->user->identity || \Yii::$app->user->isGuest) {

                $username = isset(\Yii::$app->request->post()['username']) && \Yii::$app->request->post()['username'] ? \Yii::$app->request->post()['username'] : null;

                $password = isset(\Yii::$app->request->post()['password']) && \Yii::$app->request->post()['password'] ? \Yii::$app->request->post()['password'] : null;

                if ($username && $password) {
                    $user = User::findOne(['username' => $username, 'password_hash' => $password]);

                    if ($user->validate()) {
                        //log this user in if the identity is verified
                        \Yii::$app->user->login($user);

                        $user->access_token = \Yii::$app->security->generateRandomString();

                        $user->auth_key = "_8jwIF7Os8s_lLXNxYFW24fgfCg1x-2E";

                        $user->save();

                        $message[] = $user;

                    } else {
                        //add error message
                        $message[] = "Wrong login credentials";
                    }

                } else {
                    $message[] = "Must provide username and password";
                }
            } else {
                $message[] = "you are already logged in";
            }
        }


        return $message;

    }

    /**
     * Simple action that just returns text that will be serialized to the
     * format required by the request.
     *
     * @return string
     */
    public function actionIndex()
    {
        return "Module controller";
    }


}
