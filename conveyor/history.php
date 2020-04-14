<!doctype html>

<?php 
    include '../koneksi.php';
    
    session_start();
    
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['username']==""){
	header("location:../index.php?pesan=gagal");
    }
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="admin.css">
    <title>History</title>
    <link rel="icon" href="../resource/careapp-favicon1.png">
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-dark bg-dark">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0">Call and Report Application</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php"><font color="white">Sign out</font></a>
        </li>
    </ul>
    </nav>
    <!-- Navbar End -->

    <!-- grid content -->
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-2">
                <!-- sidebar -->
                <ul class="nav fixed-top flex-column  mt-xl-5 bg-dark h-100" style="width: 13%">
                
                <center>
                    <img src="../admin/resource/logo2.png" width="80" height="80">
                </center>

                    <li class="nav-item">
                        <img src="../admin/resource/icons8-popup.png">
                        <a class="btn btn-dark" href="home.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <img src="../admin/resource/icons8-history.png">
                        <a class="btn btn-dark" href="history.php">History</a>
                    </li>
                </ul>
                <!-- end sidebar -->
            </div>
            <div class="col-md-10">
                <br>
                <br>
                <br>
                <?php
                    $conv_name = $_SESSION['username'];
                    $query = mysqli_query($koneksi, "SELECT nama FROM conveyor WHERE username='$conv_name'");
                    $tmp = mysqli_fetch_array($query);
                    $tmp1 = $tmp['nama'];
                ?>
                <h3>History Kerusakan Conveyor <?php echo $tmp1 ?></h3>
                <div id="clock"></div>
                <br>

                <table class="table table-sm">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama GL</th>
                        <th scope="col">Shift</th>
                        <th scope="col">Waktu Submit</th>
                        <th scope="col">Waktu Selesai</th>
                        <th scope="col">Kerusakan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Konfirmasi GL</th>
                        <th scope="col">Konfirmasi Teknisi</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    
                    <?php

                    $query = mysqli_query($koneksi,"SELECT * FROM problem WHERE conveyor='$tmp1' ORDER BY id DESC");
                    $nomor=1;
                    foreach($query as $row){
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
                            <th scope='row'>".$nomor++."</th>
                            <td>".$row['nama_gl']."</td>
                            <td>".$row['shift']."</td>
                            <td>".$dateformatstart."</td>";
                            if($row['end_date'] != NULL){
                                echo "<td>".$dateformatend."";
                                if($date2 != NULL){
                                    $total_date = "<br>$hours Jam, $minutes Menit, $seconds Detik</td>";
                                    echo $total_date;
                                }
                                echo"</td>";
                            }else{
                                echo "<td> </td>";
                            }
                            echo"
                            <td>".$row['kerusakan']."</td>
                            <td>".$row['keterangan']."</td>
                            <td>";
                                if($row['konfirmasi_gl'] == NULL){
                                    echo'
                                    <form action="insertpassgl.php" method="GET">
                                    <input type="password" class="form-control" name="pass_gl">';
                                    echo"<input type='hidden' class='form-control' name='id' value=$row[id]>";
                                    echo"<button type='submit' class='btn-primary mb-2'>Confirm</button>
                                    </form>";
                                }else{
                                    echo'<img src="../resource/done1.png" class="rounded mx-auto d-block" alt="...">';
                                }
                                
                            echo"
                            </td>
                            <td>";
                                if($row['konfirmasi_teknisi'] == NULL){
                                    echo'<img src="../resource/notyet2.png" class="rounded mx-auto d-block" alt="...">';
                                }else{
                                    echo'<img src="../resource/done1.png" class="rounded mx-auto d-block" alt="...">';
                                }
                            echo"
                            </td>
                            <td>".$row['status']."<br></td>
                            </tr>
                        </tbody>";
                    }
                    ?>
                </table>

            </div>
    	</div>
    </div>
    <!-- grid content akhir -->


    <!-- JavaScript -->
    <script src="../jquery/jquery-3.4.1.min.js"></script>
	<script src="../waktu.js"></script>
    <script src="../form.js"></script>

  </body>
</html>