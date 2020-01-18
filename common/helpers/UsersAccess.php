<?php

namespace app\common\helpers;

use Yii;


class UsersAccess
{
    public static function checkUserAccess($n)
    {
//        return true;


        if (Yii::$app->user->isGuest) return false;
        $userid = Yii::$app->user->identity->user_level;
		//echo $userid."<br>";
		//echo Yii::$app->user->identity->id;
        if (is_array($n)) {
            foreach ($n as $n1) {
                //if (Yii::$app->user->checkAccess($n1)) return true;
//                echo $userid . ' ' . $n1 . ' <br>';
//                if (Yii::$app->authManager->checkAccess($userid, $n1)) {
                if ($userid == $n1) {
                    return true;
                }
            }
        } else {
//            if (Yii::$app->authManager->checkAccess($userid, $n)) {
            if ($userid == $n) {
//				echo $n.'ada<br>';
                return true;
            } else {
//				echo $n.'gak ada<br>';
            }
        }
        return false;
    }

    public static function stringToArray($string)
    {
        $result = array();
        $datas = explode(",", $string);
        foreach ($datas as $data) {
            $data = trim($data);
            $result[] = $data;
            //echo $data.'--<br>';
        }

        return $result;

    }

    public static function checkAuth($auth)
    {
        $auth_array = UsersAccess::stringToArray($auth);
        $access = UsersAccess::checkUserAccess($auth_array);
        return $access;
    }
}

?>