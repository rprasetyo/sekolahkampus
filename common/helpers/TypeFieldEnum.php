<?php

namespace app\common\helpers;

use Yii;


class TypeFieldEnum
{
    const TYPE_STRING = 1;
    const TYPE_INTEGER = 2;
	const TYPE_FILE = 3;
	const TYPE_DOUBLE = 4;
	const TYPE_BOOLEAN = 5;
	const TYPE_EMAIL = 6;
	const TYPE_IP = 7;
	const TYPE_URL = 8;
	const TYPE_DATE = 9;
	const TYPE_DATETIME = 10;

    public static $list = [
        self::TYPE_STRING => 'Type String',
        self::TYPE_INTEGER => 'Type Integer',
        self::TYPE_FILE => 'Type File',
        self::TYPE_DOUBLE => 'Type Double',
        self::TYPE_BOOLEAN => 'Type Boolean',
        self::TYPE_EMAIL => 'Type Email',
        self::TYPE_IP => 'Type Ip',
        self::TYPE_URL => 'Type Url',
        self::TYPE_DATE => 'Type Date',
        self::TYPE_DATETIME => 'Type Datetime',
    ];
}

?>