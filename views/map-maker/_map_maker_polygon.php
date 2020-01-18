<?php

use app\models\AssetItemLocation;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\AssetMaster;
use app\models\Kelurahan;
use app\models\Kecamatan;
use app\models\Kabupaten;
use app\models\Propinsi;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItemLocation */
/* @var $form \yii\widgets\ActiveForm */
?>

<style>
    #map {
        height: 450px;
        width: 100% !important
        margin: 0px;
        padding: 0px
    }
</style>
<div id="map"></div>
<form method="post" accept-charset="utf-8" id="map_form">
    <input type="text" name="vertices" value="" id="vertices" />
    <input type="button" name="save" value="Save" id="save" />
</form>
<?php
/*
$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile("https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");
$cs->registerScriptFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqKXn86Fg2Iwc8vSU6LAKKSGaq6L83Ic");
$cs->registerScriptFile("http://google-maps-utility-library-v3.googlecode.com/svn/trunk/styledmarker/src/StyledMarker.js");
*/

$this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqKXn86Fg2Iwc8vSU6LAKKSGaq6L83Ic&libraries=drawing&callback=initialize");
//$this->registerJsFile("http://google-maps-utility-library-v3.googlecode.com/svn/trunk/styledmarker/src/StyledMarker.js");
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
<script>
    var map; // Global declaration of the map
    var iw = new google.maps.InfoWindow(); // Global declaration of the infowindow
    var lat_longs = new Array();
    var markers = new Array();
    var drawingManager;

    function initialize() {
        var myLatlng = new google.maps.LatLng(40.9403762, -74.1318096);
        var myOptions = {
            zoom: 13,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            polygonOptions: {
                editable: true
            }
        });
        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            var newShape = event.overlay;
            newShape.type = event.type;
        });

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            overlayClickListener(event.overlay);
            $('#vertices').val(event.overlay.getPath().getArray());
        });
    }

    function overlayClickListener(overlay) {
        google.maps.event.addListener(overlay, "mouseup", function(event) {
            $('#vertices').val(overlay.getPath().getArray());
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);

    $(function() {
        $('#save').click(function() {
            //iterate polygon vertices?
        });
    });

</script>
