<?php

use app\common\labeling\CommonActionLabelEnum;
use app\models\JenisSekolah;
use app\models\Kabupaten;
use app\models\Propinsi;
use app\models\StatusMilik;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sekolah */
/* @var $form yii\widgets\ActiveForm */
?>
<link href="<?php echo Yii::getAlias('@web') ?>/leaflet/leaflet.css" rel="stylesheet">
<style>
    div.required label.control-label:after {
        content: " *";
        color: red;
    }

    #map {
        height: 450px;
        width: 100% !important
        margin: 0px;
        padding: 0px
    }
</style>

<?php
//CSS Ini digunakan untuk overide jarak antar form biar tidak terlalu jauh
?>
<style>
    .form-group {
        margin-bottom: 0px;
    }
</style>

<div class="sekolah-form box box-success">

    <div class="box-header with-border">
        <p>
            <?= Html::a('<< ' . CommonActionLabelEnum::BACK, ['index'], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>

    <div class="box-header with-border">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Sekolah</h3>
                    </div>
                    <br/>
                    <?php $form = \yii\bootstrap\ActiveForm::begin([
                        'layout' => 'horizontal',
                        //'action' => ['index1'],
                        //'method' => 'get',
                        'fieldConfig' => [
                            'horizontalCssClasses' => [
                                'label' => 'col-sm-3',
                                'offset' => 'col-sm-offset-2',
                                'wrapper' => 'col-sm-8',
                            ],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'nama_sekolah')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'nama_sekolah_singkat')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'alias1')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'alias2')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'alias3')->textInput(['maxlength' => true]) ?>

                    <?php $dataKabupaten = ArrayHelper::map(JenisSekolah::find()->asArray()->all(), 'id_jenis_sekolah', 'jenis_sekolah');
                    echo $form->field($model, 'id_jenis_sekolah')->widget(Select2::classname(), [
                        'data' => $dataKabupaten,
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'options' => [
                            'prompt' => 'Pilih Jenis Sekolah',

                        ]
                    ]);
                    ?>

                    <?php $dataKabupaten = ArrayHelper::map(StatusMilik::find()->asArray()->all(), 'id_status_milik', 'status_milik');
                    echo $form->field($model, 'id_status_milik')->widget(Select2::classname(), [
                        'data' => $dataKabupaten,
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'options' => [
                            'prompt' => 'Pilih Status Milik',

                        ]
                    ]);
                    ?>

                    <?= $form->field($model, 'alamat1')->textInput(['id' => 'address', 'maxlength' => true]) ?>

                    <?= $form->field($model, 'alamat2')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'alamat3')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'latitude')->textInput(['id' => 'latitude', 'maxlength' => true]) ?>

                    <?= $form->field($model, 'longitude')->textInput(['id' => 'longitude', 'maxlength' => true]) ?>

                    <?php $dataKabupaten = ArrayHelper::map(Propinsi::find()->asArray()->all(), 'id_propinsi', 'nama_propinsi');
                    echo $form->field($model, 'id_propinsi')->widget(Select2::classname(), [
                        'data' => $dataKabupaten,
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'options' => [
                            'prompt' => 'Pilih Provinsi',
                            'onchange' => '
                                $.post( "' . Yii::$app->urlManager->createUrl('sekolah/lists?id=') . '"+$(this).val(), function( data ) {
                                $( "select#sekolah-id_kabupaten" ).html( data );
                                });
                    
                                ']
                    ]);
                    ?>


                    <?php $dataKabupaten = ArrayHelper::map(Kabupaten::find()->asArray()->all(), 'id_kabupaten', 'nama_kabupaten');
                    echo $form->field($model, 'id_kabupaten')->widget(Select2::classname(), [
                        'data' => $dataKabupaten,
                        'options' => ['placeholder' => 'Pilih Kabupaten ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'medsos1')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'medsos2')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'medsos3')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'medsos4')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'medsos5')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description1')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'description2')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'description3')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'description4')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'description5')->textarea(['rows' => 6]) ?>

                    <div class="box-footer">
                        <div class="form-group">
                            <?= Html::submitButton(CommonActionLabelEnum::SAVE, ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pilih Lokasi Sekolah</h3>
                    </div>
                    <div id="map"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') ?>/leaflet/leaflet.js"></script>
<?php
$this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqKXn86Fg2Iwc8vSU6LAKKSGaq6L83Ic&callback=initMap");
$this->registerJsFile("http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js");
?>
<script>
    var map;

    function initMap() {
        var myLatlng = new google.maps.LatLng(-6.903363, 107.6081381);
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();

        var myOptions = {
            zoom: 8,
            gestureHandling: 'greedy',
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);

        var icons = '<?php echo Yii::getAlias('@web') . '/images/school.png'?>';
        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        marker = new google.maps.Marker({
            map: map,
            icon: icons,
            position: myLatlng,
            draggable: true
        });

        geocoder.geocode({'latLng': myLatlng}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#latitude,#longitude').show();
                    $('#address').val(results[0].formatted_address);
                    $('#latitude').val(marker.getPosition().lat());
                    $('#longitude').val(marker.getPosition().lng());
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }
            }
        });

        google.maps.event.addListener(marker, 'dragend', function () {

            geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('#address').val(results[0].formatted_address);
                        $('#latitude').val(marker.getPosition().lat());
                        $('#longitude').val(marker.getPosition().lng());
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    }
                }
            });
        });
    }

    google.maps.event.addDomListener(window, 'load', init_map);

</script>
