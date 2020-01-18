<?php

use app\common\utils\EncryptionDB;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'SHP Map';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="<?php echo Yii::getAlias('@web') ?>/leaflet/leaflet.css" rel="stylesheet">

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
<?php
$url = __DIR__.'/web/repository/geojson/map.geojson';
$paises=json_decode($url,true);
?>
<div class="test-map-list box box-success">
    <div class="row">
        <div class="col-md-9">
            <div class="box-body" style="">
                <div id="map"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box-body" style="">
                <label class="container">Base Map Wilayah RBI
                    <p><?php echo $paises?></p>

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

<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') ?>/leaflet/leaflet.js"></script>

<script>
    //load data
    var map = L.map('map').setView([-6.409847, 108.034181], 13);
    var base_url = "<?= Yii::$app->request->baseUrl?>";


    // load a tile layer
    var tileLayer = new L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="#">OpenStreetMap</a> contributors',
        maxZoom: 20,
        minZoom: 5,
        id: 'mapbox.light'
    });
    tileLayer.addTo(map);

    $.getJSON("http://toko.teraselektronik.id/wilayahJawaTengah.geojson", function (data) {
        geoLayer = L.geoJson(data, {
            style: function (feature) {
                var kategori = feature.properties.kategori;
                if (kategori == 1) {//pertanian
                    return {
                        fillOpacity: 0.8,
                        weight: 1,
                        opacity: 0,
                        color: "#1a13b8"
                    };
                } else {//pemukiman
                    return {
                        fillOpacity: 0.8,
                        weight: 1,
                        opacity: 0,
                        color: "#b06d2e"
                    };
                }
            },
            onEachFeature: function (feature, layer) {
                var kode = feature.properties.kode;
                var kabupaten = feature.properties.KABUPATEN;

                var info_bidang = "<h5 style='text-align:center'>INFO BIDANG</h5>";
                info_bidang += "<a href='<?php echo Url::base()?>home/bidang_detail/" + kode + "'><img src='https://disk.mediaindonesia.com/thumbs/600x400/news/2016/11/mukim.jpg' height='180px' width='230px' /></a>";
                info_bidang += "<div style='width: 100%; text-align: center; margin-top:10px;'><a href='<?php echo Url::base()?>home/bidang_detail/" + kode + "'> DETAIL </a></div>";
                info_bidang += "<div style='width: 100%; text-align: center; margin-top:10px;'><p>"+kabupaten+"</p></div>";
                layer.bindPopup(info_bidang, {
                    maxWidth: 260,
                    closeButton: true,
                    offset: L.point(0, -12)
                });
                layer.on('click', function () {
                    layer.openPopup();
                });
            }
        }).addTo(map);
    });

    function groupClick(event) {
        alert("Clicked on marker" + event.layer.id);
    }

</script>
