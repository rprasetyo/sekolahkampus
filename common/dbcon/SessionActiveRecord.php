<?php

namespace app\common\dbcon;

use Yii;

/**
 * Created by PhpStorm.
 * User: Dany Panggabean
 * Date: 26/02/2019
 * Time: 12:26
 */
class SessionActiveRecord extends \yii\db\ActiveRecord
{

    public static function getDb()
    {

        $session = Yii::$app->session;

        $companyid = $session->get('id_perusahaan');

        $lodgedb = 'company' . $companyid;

        // memeriksa apakah sudah ada instance db yang di create di params
        // jika sudah ada, memanggil db tersebut
        if (array_key_exists($lodgedb, Yii::$app->params['dbs'])) {
//            echo Yii::$app->params['dbs'][$lodgedb]->dsn;
            return Yii::$app->params['dbs'][$lodgedb];
        }

        $connection = new \yii\db\Connection([
//            'dsn' => 'mysql:host=localhost;dbname=' . $lodgedb,
            'dsn' => 'mysql:host=localhost;dbname=' . 'company99',
            'username' => Yii::$app->params['dbuser'],
            'password' => Yii::$app->params['dbpasswd'],
            'charset' => 'utf8',
        ]);
        $connection->open(); // not sure if this is necessary at this point
        Yii::$app->params['dbs'][$lodgedb] = $connection;
        return $connection;
    }
}