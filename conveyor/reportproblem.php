<?php
include '../koneksi.php';

session_start();
      // cek apakah yang mengakses halaman ini sudah login
      if($_SESSION['username']==""){
        header("location:../index.php?pesan=gagal");
      }

// menyimpan data kedalam variabel
$conveyor       = $_POST['conveyor'];
$nik_gl         = $_POST['nik'];
$shift          = $_POST['shift'];
$kerusakan      = $_POST['check'] ;
$keterangan     = $_POST['keterangan'];

$gl = mysqli_query($koneksi, "SELECT nama FROM gl WHERE nik='$nik_gl'");
$row = mysqli_fetch_array($gl);
$textnama =$row['nama'];

// menyeleksi data user password yang sesuai
$confirm_nikgl = mysqli_query($koneksi,"SELECT nik FROM gl WHERE nik='$nik_gl'");

// menghitung jumlah data
$cekgl = mysqli_num_rows($confirm_nikgl);

if($cekgl > 0){

    // query SQL untuk insert data 
    foreach($kerusakan as $chk1)  
      {  
          $chk.= $chk1;  
      }
    
    foreach ($keterangan as $ket1) 
    {
        $ket.=$ket1." ";
    }

  $query="INSERT INTO problem SET conveyor='$conveyor', nama_gl='$textnama', kerusakan='$chk', nik_gl='$nik_gl', shift='$shift', keterangan='$ket'";
  mysqli_query($koneksi, $query);

  // mengalihkan ke halaman index.php
  header("location:home.php?pesan=sukses");
}else{
  header("location:home.php?pesan=gagal");
}

?>