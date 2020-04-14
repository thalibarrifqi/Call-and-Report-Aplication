<!doctype html>

<?php 
	include '../../koneksi.php';
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['username']==""){
	header("location:../../index.php?pesan=gagal");
	}
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" href="admin.css">

	<!-- JavaScript -->
	<script src="../../jquery/jquery-3.4.1.min.js"></script>
	<script src="../../waktu.js"></script>

    <title>Check GUNCLIP</title>
	<link rel="icon" href="../../resource/careapp-favicon1.png">
  </head>

  <body>

	  <!-- Navbar -->
	  <nav class="navbar fixed-top navbar-dark bg-dark">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0">Call and Report Application</a>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
			<a class="nav-link" href="../logout.php">Sign out</a>
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
					<img src="../resource/logo2.png" width="80" height="80">
				</center>
				
				<li class="nav-item">
						<img src="../resource/icons8-popup.png">
						<a class="btn btn-dark" href="../dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<img src="../resource/icons8-history.png">
						<a class="btn btn-dark" href="../history.php">History</a>
					</li>
					<li class="nav-item">
						<img src="../resource/icons8-gl.png">
						<a class="btn btn-dark" href="../gl.php">Group Leader</a>
					</li>
					<li class="nav-item">
						<img src="../resource/icons8-teknisi.png">
						<a class="btn btn-dark" href="../teknisi.php">Teknisi</a>
					</li>
					<li class="nav-item">
						<img src="../resource/icons8-admin.png">
						<a class="btn btn-dark" href="../admin.php">Admin</a>
					</li>
					<li class="nav-item">
						<img src="../resource/icons8-machine.png">
                        <a class="btn btn-dark" href="../conveyor.php">User Conveyor</a>
                    </li>
                    <li class="nav-item">
						<img src="../resource/icons8-check.png">
                        <a class="btn btn-dark" href="history_gunclip.php">Checksheet</a>
                    </li>
					<li class="nav-item">
						<img src="../resource/icons8-check.png">
                        <a class="btn btn-dark" href="gunclip.php">Gunclip</a>
                    </li>
				</ul>
				<!-- end sidebar -->
			</div>

			<div class="col-md-10">
				<br>
				<br>
				<br>
				<br>
				<h3>Checksheet Daily Gunclip</h3>
				<div id="clock"></div>
				<br>
				
				<!-- input tanggal shift -->
				<div class="container-fluid">
					
					<br>
					<b> History per Bulan </b>
					<form class="form-inline" action="history_gunclip.php" method="post">
							<div class="mb-2">
								<a>Bulan &nbsp&nbsp</a>
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
								<a>Tahun &nbsp&nbsp</a>
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
                            <div class="mb-2">
								<a>Conveyor &nbsp&nbsp</a>
							</div>
							<select class="custom-select mr-sm-3 mb-2" name="conveyor" id="inlineFormCustomSelect">
								<option value="C1">C1</option>
								<option value="C2">C2</option>
								<option value="C4">C4</option>
								<option value="C7">C7</option>
								<option value="210B">210B</option>
								<option value="TNGA">TNGA</option>
								<option value="C5A">C5A</option>
								<option value="12B">12B</option>
								<option value="14B">14B</option>
								<option value="15A">15A</option>
								<option value="16C">16C</option>
								<option value="AB3">AB3</option>
                                <option value="AB4">AB4</option>
								<option value="AB7">AB7</option>
								<option value="AB9">AB9</option>
								<option value="AB10">AB10</option>
								<option value="2B">2B</option>
								<option value="3B">3B</option>
								<option value="4B">4B</option>
								<option value="B1">B1</option>
								<option value="5A">5A</option>
								<option value="5B">5B</option>
								<option value="8A">8A</option>
								<option value="16A">16A</option>
                                <option value="AT7">AT7</option>
								<option value="AT8">AT8</option>
								<option value="AT10">AT10</option>
								<option value="AT11">AT11</option>
								<option value="15A">15A</option>
								<option value="C6">C6</option>
								<option value="B2">B2</option>
								<option value="C8">C8</option>
								<option value="AB5">AB5</option>
							</select>
						<button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
					</form>
				</div>
				<!-- akhir tanggal shift -->
				<br>
				<br>

				<!-- Tabel -->
					<div class="container-fluid">				
						<?php
							if(isset($_POST['bulan']) && isset($_POST['tahun']) && isset($_POST['conveyor'])){
								$bulan = $_POST['bulan'];
								$tahun = $_POST['tahun'];
								$conveyor = $_POST['conveyor'];

								$query = mysqli_query($koneksi, "SELECT DISTINCT * FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' GROUP BY nomor_gunclip");

								$queryscrew = mysqli_query($koneksi, "SELECT DISTINCT tanggal, screw_cutter FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' ORDER BY tanggal");

								$queryupper = mysqli_query($koneksi, "SELECT DISTINCT tanggal, upper_lower FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' ORDER BY tanggal");

								$querytang = mysqli_query($koneksi, "SELECT DISTINCT tanggal FROM data_baru WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND conveyor='$conveyor' ORDER BY tanggal");

							}else{
								error_reporting(0);
							}

							$dateObj   = DateTime::createFromFormat('!m', $bulan);
							$monthName = $dateObj->format('F');

							echo"
							<div>
							<form action='export_to_excel.php' method='POST'>
								<input type='hidden' class='form-control' name='bulan' value=$_POST[bulan]>
								<input type='hidden' class='form-control' name='tahun' value=$_POST[tahun]>
								<input type='hidden' class='form-control' name='conveyor' value=$_POST[conveyor]>
								<button type='submit' class='btn btn-primary mb-2'>Export ke Excel</button>
							</form>";

							echo'
							<br>
							<h6>PT. Jatim Autocomp Indonesia</h6>
							<h6>NYS Departement</h6>
							<h4>CV '.$conveyor.'</h4>';

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
									<th rowspan="2"><center>Nomor Gunclip</center></th>
									<th rowspan="2"><center>JOB</center></th>';

									while($blade=mysqli_fetch_assoc($queryscrew)){
										if($blade['screw_cutter']=='SUDAH DIPERBAIKI'){
											echo'<th><center><img src="cek3.png"></center></th>';
										}else if($blade['screw_cutter']=='OK'){
											echo'<th><center><img src="cek1.png"></center></th>';
										}else if($blade['screw_cutter']=='N-OK'){
											echo'<th><center><img src="cek2.png"></center></th>';
										}
									}
									
								echo'								
								</tr>
								<tr>
									<th>Upper Lower+Lock Tension Knob</th>';

									while($upper=mysqli_fetch_assoc($queryupper)){
										if($upper['upper_lower']=='SUDAH DIPERBAIKI'){
											echo'<th><center><img src="cek3.png"></center></th>';
										}else if($upper['upper_lower']=='OK'){
											echo'<th><center><img src="cek1.png"></center></th>';
										}else if($upper['upper_lower']=='N-OK'){
											echo'<th><center><img src="cek2.png"></center></th>';
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
					</div>
				<!-- akhir tabel -->
			</div>			
		</div>
	</div>    
  </body>
</html>