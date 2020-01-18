<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;
use yii\helpers\ArrayHelper;

use app\models\RequestPick;
use app\common\helpers\Timeanddate;



?>


<?php
//$urlpost = Url::toRoute(['sa-answer-certificate/receiveanswer']);

//Untuk generate datanya
//Difilter per device dan per tanggal
// (Sementara auntuk tanggal harcode dulu karena filternya belum dibuat)
$logs = RequestPick::find()
//    ->Where(['id_request_pick'])
//    ->andWhere(['log_date'=> '2019-07-24'])
//    ->orderBy('log_time DESC')
    ->all();
//$sumbu_x_data = array();
//$sumbu_y_data = array();
//foreach($logs as $log){
//Label Sumbu X
//    $sumbu_x_data[] = Timeanddate::getTimeOnly($log->log_time);
//    $sumbu_y_data[] = $log->value2;
//}
?>
<p class="text-center">
    <strong>FREKUENSI BULANAN </strong>
</p>

<div class="chart" >

    <?= ChartJs::widget([
        'type' => 'pie',
        'options' => [
            'height' => 200,
            'width' => 600
        ],
        'data' => [
//            'labels' => ["Kecil", "Sedang", "Besar"],
            'datasets' => [
                [

                    'backgroundColor'=> ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    'label'=> '# of Votes',
                    'data' => [415, 105, 90,]
                ],

            ]
        ],
        'clientOptions' => [
            'legend' => [
                'display' => true,
                'position' => 'left',
                'border' => true,
                'labels' =>[
                    'fontSize' => 25,
                    'fontColor' => "#425062"
                ]
            ],
        ],
    ]);?>
</div>
<br>

