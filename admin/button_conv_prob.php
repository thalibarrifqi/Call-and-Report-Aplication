<?php
    include '../koneksi.php';
    $hari=date('d');
    $bulan=date('m');
    $tahun=date('Y');
    $queryprob=mysqli_query($koneksi, "SELECT DISTINCT conveyor FROM problem WHERE DAY(date)='$hari' AND MONTH(date)='$bulan' AND YEAR(date)='$tahun' AND status != 'Selesai'");
    foreach($queryprob as $conv){
        echo"<button type='button' class='btn btn-danger'>".$conv['conveyor']."</button> &nbsp";
        
    }
?>