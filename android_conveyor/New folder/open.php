<?php

$mysqli = new mysqli("localhost","root","","jai_new");
$username = $_GET['username'];

$cekdashboard=mysqli_query($mysqli, "SELECT username from dashboard_teknisi_online WHERE username='$username'");
$dashboardcekjumlah = mysqli_num_rows($cekdashboard);

if($dashboardcekjumlah == 0){
	$insert = mysqli_query($mysqli, "INSERT INTO dashboard_teknisi_online SET username='$username'");
}

?>