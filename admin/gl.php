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

    <title>Group Leader</title>
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
				<h3>Group Leader</h3>
				<div id="clock"></div>
				<br>

				<!-- Tabel -->
				<br>
				<a class="btn  btn-primary" href="gl/addgl.php">Add GL</a> |
				<a class="btn  btn-primary" href="gl/addglexcel.php">Import From Excel</a>
				<a style="float: right" class="btn  btn-primary" href="gl/deleteallgl.php">Delete All</a>
				<br>

				<br>
				<div class="container-fluid">
				<table class="table table-sm">
						<thead>
							<tr>
							<th scope="col">No</th>
							<th scope="col">NIK</th>
							<th scope="col">Nama</th>
							<th scope="col">Action</th>
							</tr>
						</thead>
						
						<?php

						$query = mysqli_query($koneksi,"SELECT * FROM gl ORDER BY nama ASC");
						$nomor=1;
						foreach($query as $row){
							echo"	
							<tbody>
								<tr>
								<th scope='row'>".$nomor++."</th>
								<td>".$row['nik']."</td>
								<td>".$row['nama']."</td>
								<td>
								<a href='gl/editgl.php?id=$row[id]'>
								<span><img src='resource/icons8-edit2.png'>Edit</span>
								</a> 
								|| 
								<a href='gl/deletegl.php?id=$row[id]'>
									<span><img src='resource/icons8-dustbin2.png'>Delete</span>
								</a>
								</td>
								</tr>
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