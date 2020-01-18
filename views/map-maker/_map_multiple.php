<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\AssetMaster;
use app\models\Kelurahan;
use app\models\Kecamatan;
use app\models\Kabupaten;
use app\models\Propinsi;

/* @var $this yii\web\View */
/* @var $model app\models\AssetItemLocation */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
	#map-canvas {
		height: 450px;
		width: 100% !important
		margin: 0px;
		padding: 0px
	}
</style>
<div id="map-canvas"></div>
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

<script>
function initialize() {
    var infos = [];
	
    //var locations = [
    //    [54.08655, 13.39234],
    //    [53.56783, 13.27793],
    //];
	
	var locations = <?php echo $data ?>;


    var myOptions = {
        zoom : 15,
        center : new google.maps.LatLng(<?php echo $first_latitude; ?>, <?php echo $first_longitude; ?>),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        }
    };


    var map = new google.maps.Map(document.getElementById('map-canvas'),myOptions);

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

    var bounds = new google.maps.LatLngBounds();

    for (i = 0; i < locations.length; i++) {
		/*
        var marker = new google.maps.Marker({
			title:locations[i][3],
            position: new google.maps.LatLng(locations[i][0], locations[i][1]),
			//icon:new google.maps.MarkerImage(locations[i][2], new google.maps.Size(30,37), new google.maps.Point(0,0), new google.maps.Point(15,37)), // gak ke pakai
            map: map,
            content: locations[i][4],
        });
		*/
		
		// style marker
		/*
		styleIcon = new StyledIcon(StyledIconTypes.BUBBLE,{color:locations[i][6],text:locations[i][5],fore:'#fff'});
		var marker = new StyledMarker({
			styleIcon:styleIcon,
			title:locations[i][3],
            position: new google.maps.LatLng(locations[i][0], locations[i][1]),
            map: map,
            content: locations[i][4],
			//animation: google.maps.Animation.DROP, // BOUNCE / DROP
		});
		*/
		
		var marker = new google.maps.Marker({
			title:locations[i][3],
            position: new google.maps.LatLng(locations[i][0], locations[i][1]),
			//icon:new google.maps.MarkerImage(locations[i][2], new google.maps.Size(30,37), new google.maps.Point(0,0), new google.maps.Point(15,37)), // gak ke pakai
            map: map,
            content: locations[i][4],
			//icon: locations[i][2],
        });

        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(marker, 'click', (function (marker, i, infowindow) {
            return function () {
                //console.log('Klick! Marker=' + this.content);
                infowindow.setContent(this.content);
                infowindow.open(map, this);
            };
        })(marker, i, infowindow));
        bounds.extend(marker.position);

       // google.maps.event.trigger(marker, 'click'); un coment apabila ingin inonya muncul saat di mulai page
    }

    map.fitBounds(bounds);

    var listener = google.maps.event.addListenerOnce(map, "idle", function () {
        map.setZoom(12);
		map.setCenter(new google.maps.LatLng(<?php echo $first_latitude; ?>, <?php echo $first_longitude; ?>));
    });
}

function loadScript() {
    //var script = document.createElement('script');
    //script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
    //document.body.appendChild(script);
	initialize();
}

window.onload = loadScript;
</script>
