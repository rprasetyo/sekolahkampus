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


$this->title = 'Map Maker - Polyline';
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
//$models = $dataProviderDisplay->getModels();
?>
<div class="asset-item-list box box-success">
	<div class="row">
			<div class="box-body" style="">
				<div id="map-canvas"></div>
<!--				<form method="post" accept-charset="utf-8" id="map_form">-->
<!--					<input type="text" name="vertices" value="" id="vertices" />-->
<!--					<input type="button" name="save" value="Save" id="save" />-->
<!--				</form>-->
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

?>

<script>
    function initMap() {
        var lat_lng = {lat:-7.975293, lng: 110.923327};
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 15,
            center: lat_lng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        poly = new google.maps.Polyline({
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 3
        });
        poly.setMap(map);

        // Add a listener for the click event
        map.addListener('click', addLatLng);
    }


    // Add a new point to the Polyline.
    function addLatLng(event) {
        var path = poly.getPath();
        path.push(event.latLng);

        // Add a new marker at the new plotted point on the polyline.
        var marker = new google.maps.Marker({
            position: event.latLng,
            title: '#' + path.getLength(),
            map: map
        });
    }
    google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
        overlayClickListener(event.overlay);
        $('#vertices').val(event.overlay.getPath().getArray());
    });

    function overlayClickListener(overlay) {
        google.maps.event.addListener(overlay, "mouseup", function(event) {
            $('#vertices').val(overlay.getPath().getArray());
        });
    }

    function loadScript() {
    //var script = document.createElement('script');
    //script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
    //document.body.appendChild(script);
        initMap();
}

window.onload = loadScript;
</script>

