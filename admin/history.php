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

	<!-- JavaScript -->
	<script src="../jquery/jquery-3.4.1.min.js"></script>
	<script src="../waktu.js"></script>

    <title>History</title>
	<link rel="icon" href="../resource/careapp-favicon1.png">
  </head>

  <body>

	  <!-- Navbar -->
	  <nav class="navbar fixed-top navbar-dark bg-dark">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0">Call and Report Application</a>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
			<a class="nav-link" href="logout.php">Sign out</a>
			</li>
		</ul>
	  </nav>
	  <!-- Navbar End -->

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<!-- sidebar -->
				<ul class="nav fixed-top flex-column  mt-xl-5 bg-dark h-100" style="width: 13%">
				
				<center>
					<img src="resource/logo2.png" width="80" height="80">
				</center>
				
				<li class="nav-item">
						<img src="resource/icons8-popup.png">
						<a class="btn btn-dark" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<img src="resource/icons8-history.png">
						<a class="btn btn-dark" href="history.php">History</a>
					</li>
					<li class="nav-item">
						<img src="resource/icons8-gl.png">
						<a class="btn btn-dark" href="gl.php">Group Leader</a>
					</li>
					<li class="nav-item">
						<img src="resource/icons8-teknisi.png">
						<a class="btn btn-dark" href="teknisi.php">Teknisi</a>
					</li>
					<li class="nav-item">
						<img src="resource/icons8-admin.png">
						<a class="btn btn-dark" href="admin.php">Admin</a>
					</li>
					<li class="nav-item">
						<img src="resource/icons8-machine.png">
                        <a class="btn btn-dark" href="conveyor.php">User Conveyor</a>
                    </li>
					<!-- <li class="nav-item">
						<img src="resource/icons8-check.png">
                        <a class="btn btn-dark" href="gunclip/history_gunclip.php">Check Gunclip</a>
                    </li> -->
				</ul>
				<!-- end sidebar -->
			</div>

			<div class="col-md-10">
				<br>
				<br>
				<br>
				<br>
				<h3>History</h3>
				<div id="clock"></div>
				<br>
				
				<!-- input tanggal shift -->
				<div class="container-fluid">
					<br>
					<b> History per Hari </b>
					<form class="form-inline" action="history.php" method="post">
							<div class="mb-2">
								<a>Tanggal</a>
							</div>
							<div class="form-group mx-sm-3 mb-2">
								<input type="date" class="form-control" name="tanggal" id="inputDate" placeholder="Date">
							</div>
							<div class="mb-2">
								<a>Pilih Shift &nbsp&nbsp</a>
							</div>
							<select class="custom-select mr-sm-3 mb-2" name="shift" id="inlineFormCustomSelect">
								<option value="A">Shift A</option>
								<option value="B">Shift B</option>
							</select>
						<button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
					</form>
					<br>
					<b> History per Bulan </b>
					<form class="form-inline" action="history.php" method="post">
							<div class="mb-2">
								<a>Pilih Bulan &nbsp&nbsp</a>
							</div>
							<select class="custom-select mr-sm-3 mb-2" name="bulan" id="inlineFormCustomSelect">
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
							<div class="mb-2">
								<a>
									Pilih Tahun &nbsp&nbsp
								</a>
							</div>
							<select class="custom-select mr-sm-3 mb-2" name="tahun" id="inlineFormCustomSelect">
							
							<?php
								$currently_selected = date('Y'); 
								$earliest_year = 2010; 
								$latest_year = date('Y'); 
								foreach ( range( $latest_year, $earliest_year ) as $i ) {
									print '<option value="'.$i.'"'.($i === $currently_selected?'selected="selected"':'').'>'.$i.'</option>';
								}
							?>
							
							</select>
						<button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
					</form>
				</div>
				<!-- akhir tanggal shift -->

				<!-- Tabel -->
				<div class="container-fluid">
				
				</div>
				<br>
				<br>
				<table class="table table-sm table-bordered">
						<thead>
							<tr>
							<th scope="col">No</th>
							<th scope="col">Conveyor</th>
							<th scope="col">Shift</th>
							<th scope="col">Nama GL</th>
							<th scope="col">Nama Teknisi</th>
							<th scope="col">Waktu Submit</th>
							<th scope="col">Waktu Klik</th>
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

						if(isset($_POST['tanggal']) && isset($_POST['shift'])){
							$tanggal = $_POST['tanggal'];
							$shift = $_POST['shift'];
							$query = mysqli_query($koneksi,"SELECT * FROM problem WHERE DAY(date)=DAY('$tanggal') AND MONTH(date)=MONTH('$tanggal') AND YEAR(date)=YEAR('$tanggal') and shift='$shift'");
						}else{
							error_reporting(0);
						}

						if(isset($_POST['bulan']) && isset($_POST['tahun'])){
							$bulan = $_POST['bulan'];
							$tahun = $_POST['tahun'];
							$query = mysqli_query($koneksi,"SELECT * FROM problem WHERE MONTH(date)='$bulan' AND YEAR(date)='$tahun'");
						}else{
							error_reporting(0);
						}

						$nomor=1;

						echo"
						<div>
						<form action='export_to_excel.php' method='POST'>
							<input type='hidden' class='form-control' name='bulan' value=$_POST[bulan]>
							<input type='hidden' class='form-control' name='tahun' value=$_POST[tahun]>
							<button type='submit' class='btn btn-primary mb-2'>Export ke Excel</button>
						</form>
						";
												
						foreach($query as $row){

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

							// waktu click
							$date9 = strtotime($row['start_date']);  
							$date10 = strtotime($row['click_date']);
							$hitung3 = abs($date10 - $date9); 
							$hari3 = floor($hitung3 / (60*60*24)); 
							$jam3 = floor(($hitung3 - $hari3*60*60*24) / (60*60)); 
							$menit3 = floor(($hitung3 - $hari3*60*60*24 - $jam3*60*60) / 60);  
							$detik3 = floor(($hitung3 - $hari3*60*60*24 - $jam3*60*60 - $menit3*60));

							$dateformatstart=strtotime($row['start_date']);
							$dateformatstart=date('d/M/Y H:i:s', $dateformatstart);

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

								// waktu klik
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
				</div>
				<!-- akhir tabel -->

			</div>			
		</div>
	</div>    
  </body>
</html>