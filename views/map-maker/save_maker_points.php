<?php
function pesan($msg,$url){
    echo "<script>window.alert('$msg');window.location=('$url');</script>";
}

$latitude = $_GET['lat'];
$longitude = $_GET['lng'];
$db = mysqli_connect('192.168.1.12','root','','assetmgt');
$query = "INSERT INTO asset_item_location (latitude,longitude) VALUES ('$latitude','$longitude')";

if ($db->query($query)) {
    pesan("berhasil menyimpan data marker","/map-maker/marker_points");
}else{
    pesan("gagal menyimpan data marker","/map-maker/marker_points");
}
?>
