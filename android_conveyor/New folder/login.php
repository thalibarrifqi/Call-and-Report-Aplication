<?php


$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");

$mysqli = new mysqli("localhost","root","","jai_new");
$result = mysqli_query($mysqli,"SELECT * FROM teknisi WHERE username = '".$username."' 
	AND password = '".$password."'");

if ($data = mysqli_fetch_array($result))
{
	echo '1';
	echo 'sukses';

	$cekdashboard=mysqli_query($mysqli, "SELECT username from dashboard_teknisi WHERE username='$username'");
	$cekdashboard1=mysqli_query($mysqli, "SELECT username from dashboard_teknisi_online WHERE username='$username'");
	$dashboardcekjumlah = mysqli_num_rows($cekdashboard, $cekdashboard1);

	if($dashboardcekjumlah == 0){
	$insert = mysqli_query($mysqli, "INSERT INTO dashboard_teknisi SET username='$username'");
	$insert1 = mysqli_query($mysqli, "INSERT INTO dashboard_teknisi_online SET username='$username'");
}
}
?>