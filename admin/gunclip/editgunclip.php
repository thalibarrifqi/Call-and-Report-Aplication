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

    <title>Update Data Gunclip</title>
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

            <!-- post data setelah update -->
            <?php
            // Check if form is submitted for user update, then redirect to homepage after update
            if(isset($_POST['update']))
            {   
                $id = $_POST['id'];
                $gunclip=$_POST['gunclip'];
                $job=$_POST['job'];

                // update user data
                $result = mysqli_query($koneksi, "UPDATE input_baru SET gunclip='$gunclip', job='$job' WHERE id='$id'");

                // Redirect to homepage to display updated user in list
                header("Location:gunclip.php");
            }
            ?>
            
            <!-- mendapatkan data id dari teknisi -->
            <?php
            // Display selected user data based on id
            // Getting id from url
            $id = $_GET['id'];

            // Fetech user data based on id
            $result = mysqli_query($koneksi, "SELECT * FROM input_baru WHERE id='$id'");

            while($user_data = mysqli_fetch_assoc($result))
            {
                $gunclip = $user_data['gunclip'];
                $job = $user_data['job'];
            }
            ?>

			<div class="col-md-10">
				<br>
				<h3>Edit Nomor Gunclip</h3>
				<div id="clock"></div>
				<br>
				
				<form method="POST" action="editgunclip.php">
                    <table>

                        <tr>
                            <td><label for="exampleFormControlInput1">Nomor Gunclip</label></td>
                            <td><input type="text" class="form-control" name="gunclip" id="exampleFormControlInput1" placeholder="Nomor Gunclip" value="<?php echo $gunclip ?>"></td>
                        </tr>

                         <tr>
                            <td><label for="exampleFormControlInput1">JOB</label></td>
                            <td><input type="text" class="form-control" name="job" id="exampleFormControlInput1" placeholder="JOB" value="<?php echo $job ?>"></td>
                        </tr>

                        <tr>
                            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                            <td><input type="submit" name="update" value="Update"></td>
                        </tr>
                        
                    </table>
                </form>

            </div>
            			
		</div>
	</div>    
  </body>
</html>