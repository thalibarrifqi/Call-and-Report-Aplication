<?php
// include database connection file
include ("../../koneksi.php");
session_start();
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['username']==""){
header("location:../../index.php?pesan=gagal");
}

// Delete user row from table based on given id
$result = mysqli_query($koneksi, "TRUNCATE gl");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:../gl.php");
?>