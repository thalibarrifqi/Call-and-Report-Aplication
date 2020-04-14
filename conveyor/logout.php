<?php

include '../koneksi.php';
// mengaktifkan session php
session_start();

$username=$_SESSION['username'];

$update = mysqli_query($koneksi, "DELETE FROM dashboard WHERE user='$username'");

// menghapus semua session
session_destroy();

// mengalihkan halaman ke halaman login
header("location:../index.php");
?>