<?php
    include '../koneksi.php';
    $query=mysqli_query($koneksi, "SELECT username FROM dashboard_teknisi");
    while($ambil_query=mysqli_fetch_assoc($query)){
        $ambil_query1=$ambil_query['username'];
        $tek_login=mysqli_query($koneksi, "SELECT nama FROM teknisi WHERE username='$ambil_query1'");
        foreach($tek_login as $row){
            echo $row['nama'];
            echo'<br>';
        }
    }
?>