<?php

namespace app\modules\apipub;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\apipub\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
		//Yii::configure($this, require(__DIR__ . '/config/web.php'));
		\Yii::configure($this, require __DIR__ . '/config.php')
		sss
    }
}
