<?php
    include '../koneksi.php';
    $now=date('Y-m-d');
    $queryprob=mysqli_query($koneksi, "SELECT conveyor.nama, conveyor.username, dashboard.user FROM conveyor CROSS JOIN dashboard WHERE conveyor.username=dashboard.user");
    foreach($queryprob as $conv){
        echo"<button type='button' class='btn btn-info'>".$conv['nama'] ."</button> &nbsp";
    }
?>