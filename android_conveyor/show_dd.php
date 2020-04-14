<?php

require_once('koneksi.php');
$area = $_GET['area'];

$sql = "SELECT gl_insp.nik, gl_insp.area, gl_prod.nik, gl_prod.area FROM gl_insp
LEFT JOIN gl_prod ON gl_insp.area = gl_prod.area WHERE gl_insp.area='$area'";

$r = mysqli_query($con,$sql);
	
//Memasukkan Hasil Kedalam Array
$result = array();
$row = mysqli_fetch_array($r);
array_push($result,array(
    "area"=>$row['area'],
    "nik"=>$row['nik'],
    "nik"=>$row['nik']
    ));

//Menampilkan dalam format JSON
echo json_encode(array('result'=>$result));

mysqli_close($con);

?>