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

	$cekdashboard1=mysqli_query($mysqli, "SELECT status from teknisi WHERE username='$username'");
	$dashboardcekjumlah = mysqli_num_rows($cekdashboard1);

	if($dashboardcekjumlah != 0){
	$insert1 = mysqli_query($mysqli, "UPDATE teknisi SET status='Online' WHERE username='$username'");
}
}
?>