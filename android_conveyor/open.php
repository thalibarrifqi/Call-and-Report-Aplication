<?php

$mysqli = new mysqli("localhost","root","","jai_new");
$username = $_GET['username'];

$insert = mysqli_query($mysqli, "UPDATE teknisi SET status='Online' WHERE username='$username'");

?>