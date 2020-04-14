<table class="table table-sm table-bordered">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Conveyor</th>
        <th scope="col">Shift</th>
        <th scope="col">Nama GL</th>
        <th scope="col">Nama Teknisi</th>
        <th scope="col">Waktu Submit</th>
        <th scope="col">Waktu Total</th>
        <th scope="col">Kerusakan</th>
        <th scope="col">Keterangan</th>
        <th scope="col">Konfirmasi GL</th>
        <th scope="col">Konfirmasi Teknisi</th>
        <th scope="col">Status</th>
        </tr>
    </thead>
    
    <?php
    $nomor=1;
    include '../koneksi.php';
    $hari=date('d');
    $bulan=date('m');
    $tahun=date('Y');
    $queryprob=mysqli_query($koneksi, "SELECT * FROM problem WHERE DAY(date)='$hari' AND MONTH(date)='$bulan' AND YEAR(date)='$tahun'");
                            
    foreach($queryprob as $row){

        // waktu selesai
        $date1 = strtotime($row['start_date']);
        $date2 = strtotime($row['end_date']);
        $diff = abs($date2 - $date1);
        $days = floor($diff / (60*60*24)); 
        $hours = floor(($diff - $days*60*60*24) / (60*60)); 
        $minutes = floor(($diff - $days*60*60*24 - $hours*60*60) / 60);  
        $seconds = floor(($diff - $days*60*60*24 - $hours*60*60 - $minutes*60));

        $dateformatstart=strtotime($row['start_date']);
        $dateformatstart=date('d/M/Y H:i:s', $dateformatstart);

        $dateformatend=strtotime($row['end_date']);
        $dateformatend=date('H:i:s', $dateformatend);

        echo"	
        <tbody>
            <tr>

            <!-- nomor -->
            <th scope='row'>".$nomor++."</th>

            <!-- conveyor -->
            <td>".$row['conveyor']."</td>

            <!-- shift -->
            <td>".$row['shift']."</td>

            <!-- nama gl -->
            <td>".$row['nama_gl']."</td>

            <!-- nama teknisi -->
            <td>".$row['nama_teknisi']."</td>

            <!-- waktu mulai -->
            <td>".$dateformatstart."</td>";
          
            // waktu selesai
            if($row['end_date'] != NULL){
                echo "<td>".$dateformatend."";
                $total_date = "<br>$hours jam, $minutes menit, $seconds detik</td>";
                echo $total_date;
                echo"</td>";
            }else{
                echo '<td> </td>';
            }

            // kerusakan
            echo"
            <td>".$row['kerusakan']."</td>

            <!-- keterangan -->
            <td>".$row['keterangan']."</td>";

            // konfirmasi gl
            if($row['konfirmasi_gl']==NULL){
                echo'<td><img src="../resource/notyet2.png" class="rounded mx-auto d-block"</td>';
            }else{
                echo'<td><img src="../resource/done1.png" class="rounded mx-auto d-block"</td>';
            }

            // konfirmasi teknisi
            if($row['konfirmasi_teknisi']==NULL){
                echo'<td><img src="../resource/notyet2.png" class="rounded mx-auto d-block"</td>';
            }else{
                echo'<td><img src="../resource/done1.png" class="rounded mx-auto d-block"</td>';
            }

            // status
            echo"
            <td>".$row['status']."</td>
            </tr>
        </tbody>
        ";
    }
    ?>
</table>