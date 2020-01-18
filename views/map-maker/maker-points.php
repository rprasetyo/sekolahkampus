<?php

use app\common\utils\EncryptionDB;
use app\models\AssetItemLocation;
use app\models\AssetMaster;
use app\models\AssetReceived;
use app\models\Kabupaten;
use app\models\Kecamatan;
use app\models\Kelurahan;
use app\models\TypeAssetItem1;
use app\models\TypeAssetItem2;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;


$this->title = 'Map Maker - Points';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    #map-canvas {
        height: 450px;
        width: 100% !important
        margin: 0px;
        padding: 0px
    }
</style>

<?php
$models = $dataProviderDisplay->getModels();
?>
<div class="asset-item-list box box-success">
    <div class="row">
        <div class="col-md-9">
            <div class="box-body" style="">
                <div id="map-canvas"></div>
                <form method="post" accept-charset="utf-8" id="map_form">
                    <input type="text" name="vertices" value="" id="vertices" />
                    <input type="button" name="save" value="Save" id="save" />
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box-body" style="">
                Ini Nanti Buat Panelnya
            </div>
        </div>
    </div>
</div>


<?php
/*
$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile("https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");
$cs->registerScriptFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqKXn86Fg2Iwc8vSU6LAKKSGaq6L83Ic");
$cs->registerScriptFile("http://google-maps-utility-library-v3.googlecode.com/svn/trunk/styledmarker/src/StyledMarker.js");
*/

$this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqKXn86Fg2Iwc8vSU6LAKKSGaq6L83Ic&callback=initMap&libraries=drawing");
$this->registerJsFile("http://google-maps-utility-library-v3.googlecode.com/svn/trunk/styledmarker/src/StyledMarker.js");
?>

<?php

//$first_latitude = $model->latitude;
//$first_longitude = $model->longitude;
$first_latitude = "-7.975293";
$first_longitude = "110.923327";
$data = "[";

$x=0;
foreach($models as $model){
    $x++;
    if(isset($model->assetItemLocation)){
        $lat = floatval($model->assetItemLocation->latitude)*1;
        $long = floatval($model->assetItemLocation->longitude)*1;
        if($lat != 0 && $long != 0){
            $data .= '['.$lat.', '.$long.'],';

            if($x==1){
                $first_latitude = $model->assetItemLocation->latitude;
                $first_longitude = $model->assetItemLocation->longitude;
            }
        }
    }
    //break;
}
$data .="]";
?>

<script type="text/javascript">
    var markers = [
        <?php
        $db = mysqli_connect('192.168.1.12','root','','assetmgt');
        $sql = mysqli_query($db, "SELECT * FROM asset_item_location");
        while(($data =  mysqli_fetch_assoc($sql))) {
        ?>
        {
            "lat": '<?php echo $data['latitude']; ?>',
            "long": '<?php echo $data['longitude']; ?>',
        },
        <?php
        }
        ?>
    ];
</script>

<script>
    window.onload = function () {

        var mapOptions = {
            center: new google.maps.LatLng(-7.975293,110.923327),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var infoWindow = new google.maps.InfoWindow();
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        var drawingManager = new google.maps.drawing.DrawingManager({
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [google.maps.drawing.OverlayType.MARKER]
            }
        });
        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, 'markercomplete', function(marker){
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            if (confirm('Anda ingin menyimpan marker ini?')){
                window.location.href = "save_maker_points.php?lat="+lat+"&lng="+lng;
            }
        });

        for (i = 0; i < markers.length; i++) {
            var data = markers[i];
            var latnya = data.lat;
            var longnya = data.long;
            var myLatlng = new google.maps.LatLng(latnya, longnya);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.keterangan
            });
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent('<b>Keterangan</b> :' + data.keterangan + '<br>');
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
    }
</script>

