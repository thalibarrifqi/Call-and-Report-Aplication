<?php
    include '../koneksi.php';
    $hari=date('d');
    $bulan=date('m');
    $tahun=date('Y');
    $prob_sel=mysqli_query($koneksi, "SELECT status FROM problem WHERE status='Selesai' AND DAY(date)='$hari' AND MONTH(date)='$bulan' AND YEAR(date)='$tahun'");
    $tmp = mysqli_num_rows($prob_sel);
    echo $tmp;
?>