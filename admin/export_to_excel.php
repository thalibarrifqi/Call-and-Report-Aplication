<!doctype html>
<html lang="en">
    <head>
      
      <?php 
      session_start();
      // cek apakah yang mengakses halaman ini sudah login
      if($_SESSION['username']==""){
        header("location:../index.php?pesan=gagal");
      }
      ?>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <title>Monitoring Mesin Conveyor</title>
    </head>
  
    <body>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">PT. Jatim Autocomp Indonesia</h1>
      </div>
    </div>

    <!-- container -->
    <div class="container">
    
    <div class="jam" id="clock"></div>
    
    <?php
	    header("Content-type: application/vnd-ms-excel");
	    header("Content-Disposition: attachment; filename=Data History.xls");
	  ?>

    <?php
        include '../koneksi.php';
        $bulan = $_POST['bulan'];
        $dateObj   = DateTime::createFromFormat('!m', $bulan);
        $monthName = $dateObj->format('F');
        $tahun = $_POST['tahun'];
        echo"<b>Data Bulan $monthName</b>"; 
        echo"<b><br> Tahun $tahun</b>";
    ?>

      <!-- Content here -->
        <table class="tabel" border="1px">  
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Conveyor</th>
              <th scope="col">Shift</th>
              <th scope="col">Nama GL</th>
              <th scope="col">Nama Teknisi</th>
              <th scope="col">Waktu Submit</th>
              <th scope="col">Waktu Dilihat</th>
              <th scope="col">Waktu Scan</th>
              <th scope="col">Waktu Konfirmasi Teknisi</th>
              <th scope="col">Waktu Konfirmasi GL</th>
              <th scope="col">Waktu Total</th>
              <th scope="col">Kerusakan</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Konfirmasi GL</th>
              <th scope="col">Konfirmasi Teknisi</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          
          <?php 
          $bulan = $_POST['bulan'];
          $tahun = $_POST['tahun'];
          $query = mysqli_query($koneksi,"SELECT * FROM problem WHERE MONTH(date)='$bulan' AND YEAR(date)='$tahun'");

          $nomor=1;
          foreach ($query as $row){
              // waktu selesai
              $date1 = strtotime($row['start_date']);  
              $date2 = strtotime($row['end_date']);
              $diff = abs($date2 - $date1); 
              $days = floor($diff / (60*60*24)); 
              $hours = floor(($diff - $days*60*60*24) / (60*60)); 
              $minutes = floor(($diff - $days*60*60*24 - $hours*60*60) / 60);  
              $seconds = floor(($diff - $days*60*60*24 - $hours*60*60 - $minutes*60));

              // waktu scan
              $date3 = strtotime($row['start_date']);  
              $date4 = strtotime($row['scan_date']);
              $hitung = abs($date4 - $date3); 
              $hari = floor($hitung / (60*60*24)); 
              $jam = floor(($hitung - $hari*60*60*24) / (60*60)); 
              $menit = floor(($hitung - $hari*60*60*24 - $jam*60*60) / 60);  
              $detik = floor(($hitung - $hari*60*60*24 - $jam*60*60 - $menit*60));

              // waktu teknisi
              $date5 = strtotime($row['start_date']);  
              $date6 = strtotime($row['konfirmasi_date']);
              $hitung1 = abs($date6 - $date5); 
              $hari1 = floor($hitung1 / (60*60*24)); 
              $jam1 = floor(($hitung1 - $hari1*60*60*24) / (60*60)); 
              $menit1 = floor(($hitung1 - $hari1*60*60*24 - $jam1*60*60) / 60);  
              $detik1 = floor(($hitung1 - $hari1*60*60*24 - $jam1*60*60 - $menit1*60));

              // waktu gl
              $date7 = strtotime($row['start_date']);  
              $date8 = strtotime($row['gl_date']);
              $hitung2 = abs($date8 - $date7); 
              $hari2 = floor($hitung2 / (60*60*24)); 
              $jam2 = floor(($hitung2 - $hari2*60*60*24) / (60*60)); 
              $menit2 = floor(($hitung2 - $hari2*60*60*24 - $jam2*60*60) / 60);  
              $detik2 = floor(($hitung2 - $hari2*60*60*24 - $jam2*60*60 - $menit2*60));

              // waktu klik
              $date9 = strtotime($row['start_date']);  
              $date10 = strtotime($row['click_date']);
              $hitung3 = abs($date10 - $date9); 
              $hari3 = floor($hitung3 / (60*60*24)); 
              $jam3 = floor(($hitung3 - $hari3*60*60*24) / (60*60)); 
              $menit3 = floor(($hitung3 - $hari3*60*60*24 - $jam3*60*60) / 60);  
              $detik3 = floor(($hitung3 - $hari3*60*60*24 - $jam3*60*60 - $menit3*60));

              $dateformatstart=strtotime($row['start_date']);
              $dateformatstart=date('d/F/Y H:i:s', $dateformatstart);

              $dateformatend=strtotime($row['end_date']);
              $dateformatend=date('H:i:s', $dateformatend);

              $dateformatscan=strtotime($row['scan_date']);
              $dateformatscan=date('H:i:s', $dateformatscan);

              $dateformatgl=strtotime($row['gl_date']);
              $dateformatgl=date('H:i:s', $dateformatgl);

              $dateformatkon=strtotime($row['konfirmasi_date']);
              $dateformatkon=date('H:i:s', $dateformatkon);

              $dateformatclick=strtotime($row['click_date']);
              $dateformatclick=date('H:i:s', $dateformatclick);
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

                // waktu click
                if($row['click_date'] != NULL){
                  echo"<td>".$dateformatclick."";
                  $total_date4 = "<br>$jam3 jam, $menit3 menit, $detik3 detik";
                  echo $total_date4;
                  echo"</td>";
                }else{
                  echo"<td> </td>";
                }

                // waktu scan
                if($row['scan_date'] != NULL){
                  echo"<td>".$dateformatscan."";
                  $total_date1 = "<br>$jam jam, $menit menit, $detik detik";
                  echo $total_date1;
                  echo"</td>";
                }else{
                  echo"<td> </td>";
                }

                // waktu teknisi
                if($row['konfirmasi_date'] != NULL){
                  echo"<td>".$dateformatkon."";
                  $total_date2 = "<br>$jam1 jam, $menit1 menit, $detik1 detik";
                  echo $total_date2;
                  echo"</td>";
                }else{
                  echo"<td> </td>";
                }
                
                // waktu gl
                if($row['gl_date'] != NULL){
                  echo"<td>".$dateformatgl."";
                  $total_date3 = "<br>$jam2 jam, $menit2 menit, $detik2 detik";
                  echo $total_date3;
                  echo"</td>";
                }else{
                  echo"<td> </td>";
                }
                
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
                  echo"<td>Belum dikonfirmasi</td>";
                }else{
                  echo"<td>Terkonfirmasi</td>";
                }

                // konfirmasi teknisi
                if($row['konfirmasi_teknisi']==NULL){
                  echo"<td>Belum dikonfirmasi</td>";
                }else{
                  echo"<td>Terkonfirmasi</td>";
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
    </div>
  </body>
</html>