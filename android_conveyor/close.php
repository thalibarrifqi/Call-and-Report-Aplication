<?php

$koneksi = new mysqli("localhost","root","","jai_new");
$username = $_GET['username'];

$update = mysqli_query($koneksi, "UPDATE teknisi SET status=now() WHERE username='$username'");

?>