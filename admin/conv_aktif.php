<?php
    include '../koneksi.php';
    $conv_aktif=mysqli_query($koneksi, "SELECT user FROM dashboard");
    $conv_aktif1=mysqli_num_rows($conv_aktif);
    echo $conv_aktif1-1;
?>