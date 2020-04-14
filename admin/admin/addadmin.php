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
	<link rel="stylesheet" href="../admin.css">

	<!-- JavaScript -->
	<script src="../../jquery/jquery-3.4.1.min.js"></script>
	<script src="../../waktu.js"></script>

    <title>Tambah Data Admin</title>
    <link rel="icon" href="../../resource/careapp-favicon1.png">
  </head>

  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
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
		            <!-- <li class="nav-item">
			             <img src="../resource/icons8-check.png">
                        <a class="btn btn-dark" href="../gunclip/history_gunclip.php">Check Gunclip</a>
                    </li> -->
                </ul>
                <!-- end sidebar -->
                
            </div>

            <?php
                // Check if form is submitted for user update, then redirect to homepage after update
                if(isset($_POST['add']))
                {   
                    $nama=$_POST['nama'];
                    $username=$_POST['username'];
                    $password=$_POST['password'];


                    // update user data
                    $result = mysqli_query($koneksi, "INSERT INTO admin SET nama='$nama', username='$username', password='$password'");

                    // Redirect to homepage to display updated user in list
                    header("Location:../admin.php");
                }
            ?>

			<div class="col-md-10">
				<br>
				<h3>Tambah Data Admin</h3>
				<div id="clock"></div>
				<br>
				
				<form method="POST" action="addadmin.php">
                    <table>

                        <tr>
                            <td><label for="exampleFormControlInput1">Nama</label></td>
                            <td><input type="text" class="form-control" name="nama" id="exampleFormControlInput1" placeholder="Nama Admin"></td>
                        </tr>

                        <tr> 
                            <td><label for="exampleFormControlInput1">Username</label></td>
                            <td><input type="text" class="form-control" name="username" id="exampleFormControlInput1" placeholder="Username Admin"></td>
                        </tr>

                        <tr>
                            <td><label for="exampleFormControlInput1">Password</label></td>
                            <td><input type="text" class="form-control" name="password" id="exampleFormControlInput1" placeholder="Password Admin"></td>
                        </tr>

                        <tr><td></td>
                            <td><input class="btn btn-primary" type="submit" name="add" value="Tambah"></td>
                        </tr>
                        
                    </table>
                </form>

            </div>
            			
		</div>
	</div>    
  </body>
</html>