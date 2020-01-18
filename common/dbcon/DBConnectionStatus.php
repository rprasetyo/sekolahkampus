<?php

namespace app\common\dbcon;

use Yii;
use yii\base\Component;
use app\models\UserPerusahaan;

class DBConnectionStatus {

    public static function getDBConnection()
    {
        $userid = Yii::$app->user->identity->id;
        $userperusahaan = UserPerusahaan::findOne(['id_user' => $userid]);

        if (is_null($userperusahaan)) {
            $companyid = 0;
        } else {
            $companyid = $userperusahaan->id_perusahaan;
        }

        $lodgedb = 'company' . $companyid;

        $connection = new \yii\db\Connection([
            'dsn' => 'mysql:host=localhost;dbname=' . $lodgedb,
            'username' => Yii::$app->params['dbuser'],
            'password' => Yii::$app->params['dbpasswd'],
            'charset' => 'utf8',
        ]);
        //echo $connection->dsn."<br>";
        $connection->open(); // not sure if this is necessary at this point
        Yii::$app->params['dbs'][$lodgedb] = $connection;
    }

}
