<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminLtePluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/bower_components';
    public $js = [
//        'chart.js/Chart.min.js',
//        'datatables/dataTables.bootstrap.min.js',
        // more plugin Js here
    ];
    public $css = [
//        'datatables/dataTables.bootstrap.css',
        // more plugin CSS here
        'bootstrap-daterangepicker/daterangepicker.css',
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}