<?php
    include '../koneksi.php';
    $hari=date('d');
    $bulan=date('m');
    $tahun=date('Y');
    $conv_aktif=mysqli_query($koneksi, "SELECT DISTINCT conveyor FROM problem WHERE DAY(date)='$hari' AND MONTH(date)='$bulan' AND YEAR(date)='$tahun' AND status!='Selesai'");
    $tmp = mysqli_num_rows($conv_aktif);
    echo $tmp;
?>