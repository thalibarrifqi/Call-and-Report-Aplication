<?php
include '../koneksi.php';

session_start();
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['username']==""){
header("location:../index.php?pesan=gagal");
}

// menyimpan data kedalam variabel
$pass_gl = $_GET["pass_gl"];
$id = $_GET["id"];
$username = $_SESSION['username'];
$rating_gl = $_GET['rating_gl'];
$feedback_gl = $_GET['feedback_gl'];

// menyeleksi data username dan password yang sesuai
$confirm_gl = mysqli_query($koneksi, "SELECT password FROM conveyor WHERE username='$username' AND password='$pass_gl'");

$cekgl = mysqli_num_rows($confirm_gl);

if($cekgl > 0){
    $query=mysqli_query($koneksi,"UPDATE problem SET konfirmasi_gl='Terkonfirmasi', rating_gl='$rating_gl', feedback_gl='$feedback_gl' WHERE id='$id'");

    $querygldate=mysqli_query($koneksi,"UPDATE problem SET gl_date=now() WHERE id='$id'");

    $cektek=mysqli_query($koneksi, "SELECT konfirmasi_teknisi FROM problem WHERE id='$id'");
    $rowtek = mysqli_fetch_array($cektek);
    $stattek = $rowtek['konfirmasi_teknisi'];

    $cekgl=mysqli_query($koneksi, "SELECT konfirmasi_gl FROM problem WHERE id='$id'");
    $rowgl = mysqli_fetch_array($cekgl);
    $statgl = $rowgl['konfirmasi_gl'];

    $cekjumlahgl=mysqli_num_rows($cekgl);

    if($cekjumlahgl < 2){
        $querygl = mysqli_query($koneksi, "UPDATE problem SET status='Belum dikonfirmasi Teknisi' WHERE id='$id'");    
    }

    if($statgl == $stattek){
        $querystatus = mysqli_query($koneksi, "UPDATE problem SET status='Selesai' WHERE id='$id'");

        $querydate = mysqli_query($koneksi, "UPDATE problem SET end_date=now() WHERE id='$id'");
    }
    
    header("location:home.php");
}else{
    header("location:home.php");
}

?>