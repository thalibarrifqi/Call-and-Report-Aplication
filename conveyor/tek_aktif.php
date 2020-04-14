<?php
    include '../koneksi.php';
    $query=mysqli_query($koneksi, "SELECT nama, status FROM teknisi ORDER BY status DESC");
    echo'
    <table class="table table-sm table-bordeless">
    <thead>
        <tr>
        <th scope="col">Teknisi</th>
        </tr>
    </thead>';
    while($ambil_query=mysqli_fetch_assoc($query)){
        echo'<tr>';
        if($ambil_query['status']=='Online'){
            echo'<td><font size="2">'.$ambil_query['nama'].'</font></td>';
            echo'<td><img class="mt-2" src="images2.png"></td>';
        }

        if($ambil_query['status']!='Online'){
            $dateformat=strtotime($ambil_query['status']);
            $dateformat=date('d/F H:i', $dateformat);
            echo'<td><font size="2">'.$ambil_query['nama'].'</font>&nbsp</font><font size="1.5"><i>Last login '.$dateformat.'</i></font>';
        }
        
        echo'</tr>';
    }
?>