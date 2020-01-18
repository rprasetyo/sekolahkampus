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

$this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqKXn86Fg2Iwc8vSU6LAKKSGaq6L83Ic&callback=initMap&libraries=drawing");
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
    function initMap() {
        var drawingManager;
        var myOptions = {
            zoom: 5,
            center: {
                lat: 24.886,
                lng: -70.268
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map'), myOptions);
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

        function overlayClickListener(overlay) {
            google.maps.event.addListener(overlay, "mouseup", function(event) {
                $('#vertices').val(overlay.getPath().getArray());
            });
        }

        $(function() {
            $('#save').click(function() {
                //iterate polygon vertices?
            });
        });

        // Define the LatLng coordinates for the polygon's path.
        var triangleCoords = [
            [25.774, -80.190],
            [18.466, -66.118],
            [32.321, -64.757],
            [25.774, -80.190]
        ];
        var points = [

        ];
        for (var i = 0; i < triangleCoords.length; i++) {
            points.push({
                lat: triangleCoords[i][0],
                lng: triangleCoords[i][1]
            });
        }
        // Construct the polygon.
        var bermudaTriangle = new google.maps.Polygon({
            paths: points,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35
        });
        bermudaTriangle.setMap(map);
    }
    function loadScript() {
        //var script = document.createElement('script');
        //script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
        //document.body.appendChild(script);
        initMap();
    }

    window.onload = loadScript;

</script>
