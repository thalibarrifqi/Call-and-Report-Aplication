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
        header("Content-Disposition: attachment; filename=Cheksheet Daily Gunclip.xls");
	?>
        <?php
            include '../../koneksi.php';
                if(isset($_POST['bulan']) && isset($_POST['tahun']) && isset($_POST['conveyor'])){
                    $bulan = $_POST['bulan'];
                    $tahun = $_POST['tahun'];
                    $conveyor = $_POST['conveyor'];

                    $query = mysqli_query($koneksi, "SELECT DISTINCT * FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' GROUP BY nomor_gunclip");

                    $querytang = mysqli_query($koneksi, "SELECT DISTINCT tanggal FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' ORDER BY tanggal");

                    $queryscrew = mysqli_query($koneksi, "SELECT DISTINCT screw_cutter, tanggal FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' ORDER BY tanggal");

                    $queryupper = mysqli_query($koneksi, "SELECT DISTINCT upper_lower, tanggal FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' ORDER BY tanggal");

                }else{
                    error_reporting(0);
                }

                $dateObj   = DateTime::createFromFormat('!m', $bulan);
                $monthName = $dateObj->format('F');

                echo"
                <div>";

                echo'
                <h4>NYS Departement</h4>
                <h4>Checksheet Daily Gunclip</h4>
                <h2>CV '.$conveyor.'</h2>';

                echo'
                <table border="1">
                    <tr>
                        <th colspan="3">Daily Check Item</th>
                        <th colspan="22"><center>'.$monthName.', '.$tahun.'</center></th>
                        
                    </tr>
                    <tr>
                        <th colspan="3">Tanggal</th>';
                        
                        while($tanggal=mysqli_fetch_assoc($querytang)){
                            $dateformat=strtotime($tanggal['tanggal']);
                            $dateformat=date('d', $dateformat);

                            echo'<th><center>'.$dateformat.'</center></th>';
                        }
                        
                    echo'
                    </tr>
                    <tr>
                        <th>SCREW+CUTTER BLADE RAPAT</th>
                        <th rowspan="2">Nomor Gunclip</th>
                        <th rowspan="2">JOB</th>';

                        while($blade=mysqli_fetch_assoc($queryscrew)){
                            if($blade['screw_cutter']=='SUDAH DIPERBAIKI'){
                                echo'<th>OX</th>';
                            }else if($blade['screw_cutter']=='OK'){
                                echo'<th>O</th>';
                            }else if($blade['screw_cutter']=='N-OK'){
                                echo'<th>X</th>';
                            }
                        }
                        
                    echo'								
                    </tr>
                    <tr>
                        <th>Upper Lower+Lock Tension Knob</th>';

                        while($upper=mysqli_fetch_assoc($queryupper)){
                            if($upper['upper_lower']=='SUDAH DIPERBAIKI'){
                                echo'<th>OX</th>';
                            }else if($upper['upper_lower']=='OK'){
                                echo'<th>O</th>';
                            }else if($upper['upper_lower']=='N-OK'){
                                echo'<th>X</th>';
                            }
                        }
                        
                    echo'
                    </tr>';
                    while($rownom=mysqli_fetch_assoc($query)){
                        $queryband = mysqli_query($koneksi, "SELECT bandclip_actual, tanggal, nomor_gunclip FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' AND nomor_gunclip ='$rownom[nomor_gunclip]' ORDER BY tanggal");

                        $queryska = mysqli_query($koneksi, "SELECT skala_aktual, tanggal FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' AND nomor_gunclip ='$rownom[nomor_gunclip]' ORDER BY tanggal");

                        $querytar = mysqli_query($koneksi, "SELECT tarikan_aktual, tanggal FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' AND nomor_gunclip ='$rownom[nomor_gunclip]' ORDER BY tanggal");
                            echo'
                                <tr>
                                    <th>Panjang Bandclip Actual (mm)</th>
                                    <td rowspan="3"><center>'.$rownom['nomor_gunclip'].'</center></td>
                                    <td rowspan="3"><center>'.$rownom['JOB'].'</center></td>';
                                    
                                    while($rowband=mysqli_fetch_assoc($queryband)){
                                        echo'<td><center>'.$rowband['bandclip_actual'].'</center></td>';
                                    }												
                                    
                                    echo'
                                </tr>';

                            echo'
                                <tr>
                                    <th>Skala Bandclip Actual</th>';
                                    while($rowska=mysqli_fetch_assoc($queryska)){
                                        echo'<td><center>'.$rowska['skala_aktual'].'</center></td>';
                                    }
                                echo'
                                </tr>';

                            echo'
                                <tr>
                                    <th>Tarikan (Newton) Actual</th>';
                                    while($rowtar=mysqli_fetch_assoc($querytar)){
                                        echo'<td><center>'.$rowtar['tarikan_aktual'].'</center></td>';
                                    }
                                echo'
                                </tr>';
                        
                    }
                echo'
                </table>
                ';					
            ?>
        </table>
    </div>
  </body>
</html>