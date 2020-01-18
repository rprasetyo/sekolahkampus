<?php

namespace app\common\dbcon;

use app\models\UserPerusahaan;
use Yii;

/**
 * Created by PhpStorm.
 * User: Dany Panggabean
 * Date: 26/02/2019
 * Time: 12:26
 */
class LodgeActiveRecord extends \yii\db\ActiveRecord
{

    public static function getDb()
    {

        $session = Yii::$app->session;

        $companyid = $session->get('id_perusahaan');

        if (is_null($companyid)) {
            $userid = Yii::$app->user->identity->id;
            $userperusahaan = UserPerusahaan::findOne(['id_user' => $userid]);

            if (is_null($userperusahaan)) {
                $companyid = 0;
            } else {
                $companyid = $userperusahaan->id_perusahaan;
            }
        }

        $lodgedb = 'company' . $companyid;

        // memeriksa apakah sudah ada instance db yang di create di params
        // jika sudah ada, memanggil db tersebut
        if (array_key_exists($lodgedb, Yii::$app->params['dbs'])) {
//            echo Yii::$app->params['dbs'][$lodgedb]->dsn;
            return Yii::$app->params['dbs'][$lodgedb];
        }

        // jika belom ada, maka buat koneksi baru
        $connection = new \yii\db\Connection([
            'dsn' => 'mysql:host=localhost;dbname=' . $lodgedb,
            'username' => Yii::$app->params['dbuser'],
            'password' => Yii::$app->params['dbpasswd'],
            'charset' => 'utf8',
        ]);
        $connection->open(); // not sure if this is necessary at this point
        Yii::$app->params['dbs'][$lodgedb] = $connection;
        return $connection;


    }
}