<?php


$username = $_GET['username'];
$password = $_GET['password'];

$mysqli = new mysqli("localhost","root","","jai_new");
$result = mysqli_query($mysqli,"SELECT * FROM teknisi WHERE username = '$username' AND password = '$password'");

if ($data = mysqli_fetch_array($result))
{
	echo '1';
}
?>