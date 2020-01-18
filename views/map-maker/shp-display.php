<?php

use app\common\utils\EncryptionDB;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'SHP Map';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
      integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
      crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.2/dist/leaflet.draw.
css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<link rel="stylesheet" href="https://cdn.rawgit.com/mapshakers/leaflet-mapkey-icon/master/dist/MapkeyIcons.css"/>

<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
<script src="http://toko.teraselektronik.id/leaflet.ajax.min.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.2/dist/leaflet.draw-src.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdn.rawgit.com/mapshakers/leaflet-mapkey-icon/master/dist/L.Icon.Mapkey.js"></script>


<style>
    #map {
        height: 450px;
        width: 100% !important
        margin: 0px;
        padding: 0px
    }

    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .marker-pin {
        width: 30px;
        height: 30px;
        border-radius: 50% 50% 50% 0;
        background: #c30b82;
        position: absolute;
        transform: rotate(-45deg);
        left: 50%;
        top: 50%;
        margin: -15px 0 0 -15px;
    }

    .marker-pin::after {
        content: '';
        width: 24px;
        height: 24px;
        margin: 3px 0 0 3px;
        background: #fff;
        position: absolute;
        border-radius: 50%;
    }

    .custom-div-icon i {
        position: absolute;
        width: 22px;
        font-size: 22px;
        left: 0;
        right: 0;
        margin: 10px auto;
        text-align: center;
    }

    .custom-div-icon i.awesome {
        margin: 12px auto;
        font-size: 17px;
    }

    #draggablePanelList .panel-heading {
        cursor: move;
    }

    #draggablePanelList2 .panel-heading {
        cursor: move;
    }

    button.btn-settings {
        margin: 25px;
        padding: 20px 30px;
        font-size: 1.2em;
        background-color: #337ab7;
        color: white;
    }

    button.btn-settings:active {
        color: white;
    }

    .modal {
        overflow: hidden;
    }

    .modal-header {
        height: 30px;
        padding: 20px;
        background-color: #18456b;
        color: white;
    }

    .modal-title {
        margin-top: -10px;
        font-size: 16px;
    }

    .modal-header .close {
        margin-top: -10px;
        color: #fff;
    }

    .modal-body {
        color: #888;
        /*padding: 5px 35px 20px;*/
    }

    #layerwindow {
        height: 100%;
        margin: 0px;
        padding: 0px
    }

    .panel {
        width: 200px;
        height: 200px;
    }

    .resizable {
        overflow: hidden;
        resize: both
    }

    .draggable {
        position: absolute;
        z-index: 100
    }

    .draggable-handler {
        cursor: pointer
    }

    .dragging {
        cursor: move;
        z-index: 200 !important
    }

    .lbl {
        width: 121px; /*sesuaikan*/
        display: inline-block;
    }


</style>

<?php
$models = $dataProviderDisplay->getModels();
?>

<?php

//$first_latitude = $model->latitude;
//$first_longitude = $model->longitude;
$first_latitude = "-7.975293";
$first_longitude = "110.923327";
$data = "[";

$x = 0;
foreach ($models as $model) {

    if (isset($model->assetItemLocation)) {
        $lat = floatval($model->assetItemLocation->latitude) * 1;
        $long = floatval($model->assetItemLocation->longitude) * 1;

        $ic = EncryptionDB::encryptor('encrypt', $model->id_asset_item);
        $urlpeta = Url::toRoute(['/asset-item/view-detail', 'c' => $ic]);
        $urldetail = Html::a('Detail', $urlpeta, ['class' => 'btn btn-sm btn-danger']);
        if (isset($model->assetItemLocation)) {
            if (isset($model->assetItemLocation->kelurahan)) {
                $kelurahan = $model->assetItemLocation->kelurahan->nama_kelurahan;
            } else {
                $kelurahan = "-";
            }
        } else {
            $kelurahan = "--";
        }
        $info = "<b>Aset</b><br>NUP: " . $model->number1 . " / No.Urut:" . $model->number2;
        $info .= '<br>Kel: ' . $kelurahan;
        $info .= "<br><a href='" . $urlpeta . "'>Detail</a>";
        if ($lat != 0 && $long != 0) {
            $data .= '[' . $lat . ', ' . $long . ',"/images/icon/red.png","title","' . $info . '"],';
            $x++;
            if ($x == 1) {
                $first_latitude = $model->assetItemLocation->latitude;
                $first_longitude = $model->assetItemLocation->longitude;
            }
        }
    }
    //break;
}
$data .= "]";
?>

<div class="asset-item-list box box-success">
    <div class="row">
        <div class="col-md-9">
            <div class="box-body" style="">
                <div id="map"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box-body" style="">
                <label class="container">Base Map Wilayah RBI
                    <input type="checkbox" id="dataid1" checked="checked">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Layer Map Jawa Tengah
                    <input type="checkbox" id="dataid2" checked="checked">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Base Map Utama
                    <input type="checkbox" id="basemap" checked="checked">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Base Map Railway
                    <input type="checkbox" id="layerrailway" checked="checked">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Base Map Railway Indonesia
                    <input type="checkbox" id="layerkereta" checked="checked">
                    <span class="checkmark"></span>
                </label>
                <!--<button href="#myModal" class="btn btn-settings" data-backdrop="false" data-toggle="modal">Open Modal
                </button>-->
            </div>
        </div>
    </div>
</div>

<div id="panel1" class="panel panel-primary resizable draggable">
    <div class="panel-heading draggable-handler">Detail Asset</div>
    <div class="panel-body">
        <div id="listing-detail">
            <!--            <label for="latInput">Latitude</label>-->
            <!--            <input id="latInput"/>-->
            <!--            <label for="lngInput">Longitude</label>-->
            <!--            <input id="lngInput"/>-->
            <span class='lbl'> NUP / No.Urut</span>: <br/>
            <span class='lbl'> Asset Name</span>: <br/>
            <span class='lbl'> Kabupaten</span>: <br/>
            <span class='lbl'> Kecamatan</span>: <br/>
            <span class='lbl'> Kelurahan</span>: <br/>
            <span class='lbl'> Bukti Pemilikan</span>:
        </div>
    </div>
</div>

<!--<div class="box box-default color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-tag"></i> Color Palette</h3>
    </div>

</div>-->
<div id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Detail Asset</h4>

            </div>
            <div class="modal-body">
                <span class='lbl'> NUP / No.Urut</span>:<br/>
                <span class='lbl'> Asset Name</span>: <br/>
                <span class='lbl'> Kabupaten</span>: <br/>
                <span class='lbl'> Kecamatan</span>: <br/>
                <span class='lbl'> Kelurahan</span>: <br/>
                <span class='lbl'> Bukti Pemilikan</span>:
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Detail Asset</h4>
            </div>
            <div class="modal-body">
                <div id="isi"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>

    /* Layer 1*/
    //load data
    var locations = <?php echo $data ?>;

    // initialize the map
    var map = L.map('map').setView([<?php echo $first_latitude; ?>, <?php echo $first_longitude; ?>], 15);

    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);
    var drawControl = new L.Control.Draw({
        edit: {
            featureGroup: drawnItems
        }
    });
    map.addControl(drawControl);

    map.on(L.Draw.Event.CREATED, function (event) {
        var layer = event.layer;

        drawnItems.addLayer(layer);
    });

    // load a tile layer
    var tileLayer = new L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="#">OpenStreetMap</a> contributors',
        maxZoom: 20,
        minZoom: 5,
        id: 'mapbox.light'
    });
    tileLayer.addTo(map);

    var layerrailway = new L.tileLayer('http://{s}.tiles.openrailwaymap.org/standard/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="#">OpenStreetMap</a> contributors',
        maxZoom: 20,
        minZoom: 5,
        id: 'mapbox.light'
    });
    layerrailway.addTo(map);

    var icon = L.divIcon({
        className: 'custom-div-icon',
        html: "<div style='background-color:#c30b82;' class='marker-pin'></div><i class='fa fa-map-signs awesome'></i>",
        iconSize: [30, 42],
        iconAnchor: [15, 42],
    });

    var icons = L.icon.mapkey({
        icon: "tree_leaf", color: '#725139', background: '#f2c357', size: 30
    });

    for (i = 0; i < locations.length; i++) {

        var marker = L.marker([locations[i][0], locations[i][1]], {
            title: locations[i][3],
            content: locations[i][4],
            icon: icons
        }).addTo(map);
        marker.myID = i;

        marker.bindPopup(locations[i][4] ).on('click', function(e) {
            var i = e.target.myID;
            console.log(locations[i]);
            $('#mymodal').modal('show').on('shown.bs.modal', function(e) {
            });
        });
        // }).on('click',markerOnClick).addTo(map);

        // function markerOnClick(e)
        // {
        //     $('#mymodal').modal('show').on('shown.bs.modal', function(e) {
        //         var isi = locations[1];
        //     });
        // }

        // marker.bindPopup(locations[i][4]).openPopup();
        // // marker.bindPopup(locations[i][4]).openPopup();
        //
        // // marker.bindPopup(locations[i][4]).on('click', function(e) {
        // //     // var i = e.target.myID;
        // //     console.log(locations[i][4]);
        // //     $('#mymodal').modal('show').on('shown.bs.modal', function(e) {
        // //     });
        // // });

    }

    // load GeoJSON from an external file
    var staticUrl = 'http://toko.teraselektronik.id/IDN_KAB.geojson';
    var geojsonLayer = new L.GeoJSON.AJAX(staticUrl, {
        style: {
            fillColor: "#59fd02",
            fillOpacity: 0.7,
            color: "white",
            weight: 1,
            opacity: 0.7
        }
    });
    geojsonLayer.addTo(map);

    document.getElementById("dataid1").addEventListener("change", function () {
        if (document.getElementById(this.id).checked == true) {
            geojsonLayer.addTo(map);
        } else {
            geojsonLayer.remove(map);
        }
    });

    /* Layer 2 */
    var dataUrl = 'http://toko.teraselektronik.id/wilayahJawaTengah.geojson';
    var layerwilayah = new L.GeoJSON.AJAX(dataUrl, {
        style: {
            fillColor: "#2b2b2b",
            fillOpacity: 0.7,
            color: "white",
            weight: 1,
            opacity: 0.7
        }
    });
    layerwilayah.addTo(map);

    /* Layer 3 Rel Kereta */
    var dataUrls = '';
    var layerkereta = new L.GeoJSON.AJAX(dataUrls, {
        style: {
            fillColor: "#2b2b2b",
            fillOpacity: 0.7,
            color: "white",
            weight: 1,
            opacity: 0.7
        }
    });
    layerkereta.addTo(map);

    document.getElementById("dataid2").addEventListener("change", function () {
        if (document.getElementById(this.id).checked == true) {
            layerwilayah.addTo(map);
        } else {
            layerwilayah.remove(map);
        }
    });

    document.getElementById("basemap").addEventListener("change", function () {
        if (document.getElementById(this.id).checked == true) {
            tileLayer.addTo(map);
        } else {
            tileLayer.remove(map);
        }
    });

    document.getElementById("layerrailway").addEventListener("change", function () {
        if (document.getElementById(this.id).checked == true) {
            layerrailway.addTo(map);
        } else {
            layerrailway.remove(map);
        }
    });

    document.getElementById("layerkereta").addEventListener("change", function () {
        if (document.getElementById(this.id).checked == true) {
            layerkereta.addTo(map);
        } else {
            layerkereta.remove(map);
        }
    });

    $("#myModal").draggable({
        handle: ".modal-header"
    });

    // var html = window.open("http://localhost/assetmgt/web/map-maker/shp-display", "_blank", "width=800,height=600,location=no,menubar=no,status=no,titilebar=no,resizable=no,");
    var divContents = document.getElementById("layerwindow").innerHTML;

    var myWindow = window.open("", "map", "width=800,height=600");   // Opens a new window
    myWindow.document.write(divContents);
    myWindow.document.close();


</script>

<script type="text/javascript">
    $('.draggable-handler').mousedown(function (e) {
        drag = $(this).closest('.draggable')
        drag.addClass('dragging')
        drag.css('left', e.clientX - $(this).width() / 2)
        drag.css('top', e.clientY - $(this).height() / 2 - 10)
        $(this).on('mousemove', function (e) {
            drag.css('left', e.clientX - $(this).width() / 2)
            drag.css('top', e.clientY - $(this).height() / 2 - 10)
            window.getSelection().removeAllRanges()
        })
    })

    $('.draggable-handler').mouseleave(stopDragging)
    $('.draggable-handler').mouseup(stopDragging)

    function stopDragging() {
        drag = $(this).closest('.draggable')
        drag.removeClass('dragging')
        $(this).off('mousemove')
    }

</script>
