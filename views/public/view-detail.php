<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\AppVocabularySearch;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sekolah */

$this->title = CommonActionLabelEnum::VIEW . "" . AppVocabularySearch::getValueByKey(' Informasi');
$this->params['breadcrumbs'][] = ['label' => CommonActionLabelEnum::LIST_ALL . ' ' . AppVocabularySearch::getValueByKey(' Informasi'), 'url' => ['/public']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/semantic.min.css" />

<style>
    #map-canvas {
        height: 450px;
        width: 100% !important
        margin: 0px;
        padding: 0px
    }
    table {
        margin: 25px auto;
        border-collapse: collapse;
        border: 1px solid #eee;
        border-bottom: 2px solid #00cccc;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1), 0px 10px 20px rgba(0, 0, 0, 0.05), 0px 20px 20px rgba(0, 0, 0, 0.05), 0px 30px 20px rgba(0, 0, 0, 0.05);
    }

    table tr:hover {
        background: #f4f4f4;
    }

    table tr:hover td {
        color: #555;
    }

    table th, table td {
        color: #999;
        border: 1px solid #eee;
        padding: 12px 35px;
        border-collapse: collapse;
    }

    table th {
        background: #7fa998;
        color: #ffffff;
        text-transform: uppercase;
        font-size: 12px;
    }

    table th.last {
        border-right: none;
    }
    #locator-input-section {
        width: 100%;
        margin: 10px;
        max-width: 600px;

    }
    #divDirections{
        width: 100%;
        float:left;
        height: 415px;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>

<div class="public-view box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Informasi Detail</h3>
        <?= Html::a(CommonActionLabelEnum::BACK, ['/public'], ['class' => 'btn bg-olive']) ?>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Nama Sekolah',
                'attribute' => 'nama_sekolah',
            ],
            [
                'label' => 'Nama Sekolah Singkat',
                'attribute' => 'nama_sekolah_singkat',
            ],
//                'alias1',
//                'alias2',
            //'alias3',
            [
                'label' => 'Jenis Sekolah',
                'attribute' => 'jenisSekolah.jenis_sekolah',
            ],
            [
                'label' => 'Status Milik',
                'attribute' => 'statusMilik.status_milik',
            ],
            'alias1',
//            'alias2',
//            'alias3',
            [
                'label' => 'Alamat',
                'attribute' => 'alamat1',
            ],
            [
                'label' => 'Latitude',
                'attribute' => 'latitude',
            ],
            [
                'label' => 'Longitude',
                'attribute' => 'longitude',
            ],
            [
                'label' => 'Propinsi',
                'attribute' => 'propinsi.nama_propinsi',
            ],
            [
                'label' => 'Kabupaten',
                'attribute' => 'kabupaten.nama_kabupaten',
            ],
            [
                'label' => 'Website',
                'attribute' => 'website',
                'format' => 'raw',
                'value' => function ($data) {
                    $url = $data->website;
                    return Html::a($data->website, $url, ['title' => 'Go']);
                }
            ],
            [
                'label' => 'Media Social Instagram',
                'attribute' => 'medsos1',
            ],
            [
                'label' => 'Media Social Twitter',
                'attribute' => 'medsos2',
            ],
            [
                'label' => 'Media Social Facebook',
                'attribute' => 'medsos3',
            ],
            [
                'label' => 'Media Social Telegram',
                'attribute' => 'medsos4',
            ],
            [
                'label' => 'Description',
                'attribute' => 'description1',
            ],
            //'description2:ntext',
//            'description3:ntext',
//            'description4:ntext',
//            'description5:ntext',
        ],
    ]) ?>
</div>
<div class="map-view box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Tentukan Lokasi Anda</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="form-group col-md-6">
            <div class="col-sm-5 col-md-4 col-lg-5" >
                <div class="ui icon big input" id="locator-input-section">
                    <input type="text" placeholder="Lokasi Anda" id="txtAddress1" />
                    <i aria-hidden="true" class="dot circle outline link icon" id="locator-button" title="Pilih Lokasi"></i>
                </div>

            </div>
            <div class="col-sm-4 col-md-4 col-lg-3">
                <div class="ui icon big input" id="locator-input-section">
                    <button type="button" id="btnGetDirections" class="btn-lg bg-navy"><span class="fa fa-search"> Cari</span></button>
                </div>
            </div>
            <div class="col-sm-5 col-md-4 col-lg-4">
                <div class="ui icon big input" id="locator-input-section">
                    <input type="text" id="txtAddress2"  value="<?= $model->alamat1;?>" disabled hidden />
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="box-body" style="">
                <div id="map-canvas"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box-body">
                <h3 class="box-title">Petunjuk Rute Ke Tujuan Akhir</h3>
                <div class="separator"></div>
                <div id="divDirections" class="panel">

                </div>
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

$this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqKXn86Fg2Iwc8vSU6LAKKSGaq6L83Ic&libraries=places");
$this->registerJsFile("http://google-maps-utility-library-v3.googlecode.com/svn/trunk/styledmarker/src/StyledMarker.js");
?>

<?php

/*
//Data sampel
$first_latitude = 54.08655;
$first_longitude = 13.39234;
$data = '[[54.08655, 13.39234]]';
*/

//$first_latitude = -7.975293;
//$first_longitude = 110.923327;
$first_latitude = $model->latitude;
$first_longitude = $model->longitude;
$data = '[[' . $first_latitude . ', ' . $first_longitude . ']]';
?>
<script>
    function initialize() {
        var infos = [];

        var locations = <?php echo $data ?>;
        var rendererOptions = {draggable: true};
        var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
        var directionsService = new google.maps.DirectionsService();
        var locatorSection = document.getElementById("locator-input-section")
        var input = document.getElementById("txtAddress1");

        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 15,
            center: new google.maps.LatLng(<?php echo $first_latitude; ?>, <?php echo $first_longitude; ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            gestureHandling: 'greedy',
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL
            }
        });
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById("divDirections"));

        $("#btnGetDirections").click(function () {
            calcRoute($("#txtAddress1").val(), $("#txtAddress2").val());
        });

        var locatorButton = document.getElementById("locator-button");
        locatorButton.addEventListener("click", locatorButtonPressed)

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
            var icons = '<?php echo Yii::getAlias('@web') . '/images/school.png'?>';

            var marker = new google.maps.Marker({
                title: locations[i][3],
                position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                //icon:new google.maps.MarkerImage(locations[i][2], new google.maps.Size(30,37), new google.maps.Point(0,0), new google.maps.Point(15,37)), // gak ke pakai
                map: map,
                icon: icons,
                // content: locations[i][4],
                //icon: locations[i][2],
            });

            var contentString = '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<div id="bodyContent">' +
                '<p>Nama Sekolahku : <?= $model->nama_sekolah?></p>' +
                '<p>Alamat Sekolahku : <?= $model->alamat1?></p>' +
                '</div>' +
                '</div>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString,

            });

            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });

        }


        map.fitBounds(bounds);

        var listener = google.maps.event.addListenerOnce(map, "idle", function () {
            map.setZoom(12);
            map.setCenter(new google.maps.LatLng(<?php echo $first_latitude; ?>, <?php echo $first_longitude; ?>));
        });

        function calcRoute(start, end) {
            var request = {
                origin: start,
                destination: end,
                travelMode: google.maps.TravelMode.DRIVING,
                provideRouteAlternatives: false
            };
            directionsService.route(request, function (result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(result);
                }
            });
        }
        function locatorButtonPressed() {
            locatorSection.classList.add("loading")

            navigator.geolocation.getCurrentPosition(function (position) {
                    getUserAddressBy(position.coords.latitude, position.coords.longitude)
                },
                function (error) {
                    locatorSection.classList.remove("loading")
                    alert("The Locator was denied :( Please add your address manually")
                })
        }

        function getUserAddressBy(lat, long) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var address = JSON.parse(this.responseText)
                    setAddressToInputField(address.results[0].formatted_address)
                }
            };
            xhttp.open("GET", "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + long + "&key=AIzaSyDjqKXn86Fg2Iwc8vSU6LAKKSGaq6L83Ic", true);
            xhttp.send();
        }

        function setAddressToInputField(address) {

            input.value = address
            locatorSection.classList.remove("loading")
        }

        var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(45.4215296, -75.6971931),
        );

        var options = {
            bounds: defaultBounds
        };
        var autocomplete = new google.maps.places.Autocomplete(input, options);
    }

    function locate() {

        var location = document.getElementById("location");
        var apiKey = 'f536d4c3330c0a1391370d1443cee848';
        var url = 'https://api.forecast.io/forecast/';

        navigator.geolocation.getCurrentPosition(success, error);

        function success(position) {
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;

            $.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng="+latitude + "," + longitude + "&language=en", function(data) {
                var fulladd = data.results[0].formatted_address.split(",");
                var count= fulladd.length;

                $('#txtAddress1').val(fulladd[count-1]);
            });
        }

        function error() {
            location.innerHTML = "Unable to retrieve your location";
        }

    }

    function loadScript() {
        //var script = document.createElement('script');
        //script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
        //document.body.appendChild(script);
        initialize();
    }


    window.onload = loadScript;

</script>
