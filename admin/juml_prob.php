<?php
    include '../koneksi.php';
    $hari=date('d');
    $bulan=date('m');
    $tahun=date('Y');
    $juml_prob=mysqli_query($koneksi, "SELECT id FROM problem WHERE DAY(date)='$hari' AND MONTH(date)='$bulan' AND YEAR(date)='$tahun'");
    $tmp = mysqli_num_rows($juml_prob);
    echo $tmp;
?>