<?php

$koneksi = new mysqli("localhost","root","","jai_new");
$username = $_GET['username'];

$update = mysqli_query($koneksi, "DELETE FROM dashboard_teknisi_online WHERE username='$username'");

?>