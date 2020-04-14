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

    <title>List Gunclip</title>
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
						<img src="../resource/icons8-glue-gun.png">
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
				<h3>Data Gunclip</h3>
				<div id="clock"></div>
				<br>
				
				<!-- input tanggal shift -->
				<div class="container-fluid">
					
					<br>
					<b> Pilih Area </b>
					<form class="form-inline" action="gunclip.php" method="post">
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

				<!-- Tabel -->
					<div class="container-fluid">				
						<?php
							if(isset($_POST['conveyor'])){
								$conveyor = $_POST['conveyor'];
                                $nomor=1;
								$query = mysqli_query($koneksi, "SELECT * FROM input_baru WHERE area='$conveyor' ORDER BY area ASC");

							}else{
								error_reporting(0);
							}

                            echo'
                            <h4><center>CV '.$conveyor.'</center></h4>
                            <table class="table table-sm table-bordered">
                            
                                <thead>
                                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nomor Gunclip</th>
                                    <th scope="col">JOB</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>';
                                while($row=mysqli_fetch_assoc($query)){
                                    echo"
                                        <tbody>
                                            <tr>

                                            <!-- nomor -->
                                            <th scope='row'>".$nomor++."</th>

                                            <!-- conveyor -->
                                            <td>".$row['gunclip']."</td>

                                            <!-- shift -->
                                            <td>".$row['job']."</td>

                                            <!-- action -->
                                            <td>
                                                <a href='editgunclip.php?id=$row[id]'>
                                                <span><img src='../resource/icons8-edit2.png'>Edit</span>
                                                </a> 
                                                ||
                                                <a href='deletegunclip.php?id=$row[id]'>
                                                <span><img src='../resource/icons8-dustbin2.png'>Delete</span>
                                                </a>
                                            </td>

                                            </tr>
                                        </tbody>
                                    ";
                                }
                                echo'</table>';		
						?>
					</div>
				<!-- akhir tabel -->
			</div>			
		</div>
	</div>    
  </body>
</html>