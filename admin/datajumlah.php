<?php
    // Data Jumlah
    include '../koneksi.php';
	$datajumlah = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())");
    $datajumlah2 = mysqli_num_rows($datajumlah);
    echo $datajumlah2;

?>