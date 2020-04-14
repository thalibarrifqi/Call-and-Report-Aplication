<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data user dengan username dan password yang sesuai
$loginadmin = mysqli_query($koneksi,"SELECT * FROM admin WHERE username='$username' AND password='$password'");

// menghitung jumlah data yang ditemukan
$cekadmin = mysqli_num_rows($loginadmin);

// cek apakah username dan password di temukan pada database
if($cekadmin > 0){

    $dataadmin = mysqli_fetch_assoc($loginadmin);
    
    // buat session login dan username
    $_SESSION['username'] = $username;
    
	// alihkan ke halaman dashboard admin
	header("location:admin/dashboard.php");

	// cek jika user login sebagai pegawai
}else if($dataadmin == NULL){

    // menyeleksi data user dengan username dan password yang sesuai
    $logingl = mysqli_query($koneksi,"SELECT * FROM conveyor WHERE username='$username' AND password='$password'");

    // menghitung jumlah data yang ditemukan
    $cekgl = mysqli_num_rows($logingl);

    if($cekgl > 0){
        $datagl = mysqli_fetch_assoc($logingl);
        $_SESSION['username'] = $username;

        $qrcode=mt_rand(100000, 2000000);
        $query=mysqli_query($koneksi, "UPDATE conveyor SET qrcode='$qrcode' WHERE username='$username'");

        $cekdashboard=mysqli_query($koneksi, "SELECT user from dashboard WHERE user='$username'");
        $dashboardcekjumlah = mysqli_num_rows($cekdashboard);

        if($dashboardcekjumlah == 0){
            $insert = mysqli_query($koneksi, "INSERT INTO dashboard SET user='$username'");
        }

        header("location:conveyor/home.php");
    }else{
        header("location:index.php?pesan=gagal");    
    }   
}else{
    header("location:index.php");
}
?>