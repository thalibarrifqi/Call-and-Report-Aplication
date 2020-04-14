<?php
require_once('koneksi.php');
$username = $_GET['username'];

$sql = "SELECT nik, nama FROM teknisi WHERE username='$username'";
$r = mysqli_query($con,$sql);

$result = array();
while($row = mysqli_fetch_array($r)){
    array_push($result,array(
        "nik"=>$row['nik'],
        "nama"=>$row['nama']
    ));
}

echo json_encode(array('result'=>$result));

mysqli_close($con);


?>