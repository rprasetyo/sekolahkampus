<?php $module=$this->module->getName();?> 
<div class="view_xxx">
	<?php
	$data='[';
	$no=0;
	$tanks = DeviceCommon::model()->findAll();
	$x = 0;
	$first_longitude= "107.62887666667";
	$first_latitude="-6.9073083333333";
	foreach($tanks as $record){	
		/*
		$diffnow = Timeanddate::getTimeFromNow($record->LAST_TIME);
		if($diffnow > 15){
			$icon ="repository/icon/red.png";
			$colorIcon="#C50000";
		}else{
			$icon = "repository/icon/green.png";
			$colorIcon="#57a957";
		}
		*/
		$icon ="repository/icon/ship2.png";
		$x++;
		$titleMarker = Yii::t('string', $record->device_name);
		
		//set infowindow dengan nama ruang
		$url = Yii::app()->createUrl($module.'/tank/view',array('id'=>$record->id_device));
		//$url ='#';
		//$stasiun = ($record->laststasiun) ? $record->laststasiun->station_name : '--'; // gak jalan id_last_station gak ada
		$displayinfo = '<div><a href="'.$url.'"><b>'.$record->device_name.' </b></a><br></div>';
		//$displayinfo = "Informasi Apa saja";
		//$displayinfo = 'info';
		
		$data.='[';
		
		$data.= $record->last_latitude.','; // latitude
		$data.= $record->last_longitude.','; // longitude
		if($x== 1){
			$first_longitude= $record->last_longitude;
			$first_latitude=$record->last_latitude;
		}
		$data.= '"'.$icon.'",'; // icon png
		$data.= '"'.$titleMarker.'",'; // title 
		$data.= "'".$displayinfo."' ,"; // info windows / content
		
		//echo $data."<br>===========<Br>";
		
		$data.= '] , ';
		$no++;

	}
	$data.=']';
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
$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile("https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");
$cs->registerScriptFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqKXn86Fg2Iwc8vSU6LAKKSGaq6L83Ic");
$cs->registerScriptFile("http://google-maps-utility-library-v3.googlecode.com/svn/trunk/styledmarker/src/StyledMarker.js");
?>

<script>
function initialize() {
    var infos = [];
	
    //var locations = [
    //    [54.08655, 13.39234],
    //    [53.56783, 13.27793],
    //];
	
	var locations = <?php echo $data ?>;

    var map = new google.maps.Map(document.getElementById('map-canvas'), {
		zoom : 15,
		center : new google.maps.LatLng(<?php echo $first_latitude; ?>, <?php echo $first_longitude; ?>),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        }

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



<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Map</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-9 col-sm-8">
                  <div class="pad_xxx">
					<div id="map-canvas"></div>
				  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-4">
                  <div class="pad box-pane-right bg-blue" style="height: 450px">
					<div class="table-responsive">
						<table class="table no-margin" style="font-size:10px">
						  <thead>
						  <tr>
							<th>Desc</th>
							<th>Value</th>
						  </tr>
						  </thead>
						  <tbody>
						  <tr>
							<td>Name</td>
							<td>PATROL#1</td>
						  </tr>
						  <tr>
							<td>ID/MMSI</td>
							<td>12344321</td>
						  </tr>
						  <tr>
							<td>Type</td>
							<td>A</td>
						  </tr>
						  <tr>
							<td>Notes</td>
							<td>Mission</td>
						  </tr>
						  <tr>
							<td>Speed</td>
							<td>20 knot</td>
						  </tr>
						  <tr>
							<td>Course</td>
							<td>155°</td>
						  </tr>
						  <tr>
							<td>Latitude</td>
							<td>-8.506468</td>
						  </tr>
						  <tr>
							<td>Longitude</td>
							<td>125.533999</td>
						  </tr>
						  <tr>
							<td>Last Update</td>
							<td>2018-11-11 11:40:00</td>
						  </tr>
						  </tbody>
						</table>
					</div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>

</div>
<body onload="loadScript(); ">