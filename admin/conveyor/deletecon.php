<?php
// include database connection file
include ("../../koneksi.php");
session_start();
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['username']==""){
header("location:../../index.php?pesan=gagal");
}
// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM conveyor WHERE id='$id'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:../conveyor.php");
?>