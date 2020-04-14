<?php
    include '../koneksi.php';
    $tek_aktif=mysqli_query($koneksi, "SELECT username FROM dashboard_teknisi_online");
    $tek_aktif1=mysqli_num_rows($tek_aktif);
    echo $tek_aktif1;
?>