<?php
include '../koneksi.php';

session_start();
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['username']==""){
header("location:../index.php?pesan=gagal");
}

// menyimpan data kedalam variabel
$pass_teknisi = $_GET["pass_teknisi"];
$id = $_GET["id"];

// menyeleksi data user password yang sesuai
$confirm_teknisi = mysqli_query($koneksi,"SELECT password FROM teknisi WHERE password='$pass_teknisi'");

$cekteknisi = mysqli_num_rows($confirm_teknisi);

if($cekteknisi > 0){
    $query=mysqli_query($koneksi,"UPDATE problem SET konfirmasi_teknisi='Terkonfirmasi' WHERE id='$id'");

    $cektek=mysqli_query($koneksi, "SELECT konfirmasi_teknisi FROM problem WHERE id='$id'");
    $rowtek = mysqli_fetch_array($cektek);
    $stattek = $rowtek['konfirmasi_teknisi'];

    $cekgl=mysqli_query($koneksi, "SELECT konfirmasi_gl FROM problem WHERE id='$id'");
    $rowgl = mysqli_fetch_array($cekgl);
    $statgl = $rowgl['konfirmasi_gl'];

    $cekjumlahgl=mysqli_num_rows($cekgl);

    if($cekjumlahgl < 2){
        $querygl = mysqli_query($koneksi, "UPDATE problem SET status='Belum dikonfirmasi GL' WHERE id='$id'");    
    }

    if($statgl == $stattek){
        $querystatus = mysqli_query($koneksi, "UPDATE problem SET status='Selesai' WHERE id='$id'");

        $querydate = mysqli_query($koneksi, "UPDATE problem SET end_date=now() WHERE id='$id'");
    }
    
    header("location:history.php");
}else{
    header("location:history.php");
}

?>