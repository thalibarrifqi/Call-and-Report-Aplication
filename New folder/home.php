<!doctype html>

<?php 
    include '../koneksi.php';
    include '../phpqrcode/qrlib.php';
    
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

    <title>Home</title>
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
            <div class="col-md-3">
                <br>
                <br>
                <br>
                <?php
                    $conv_name = $_SESSION['username'];
                    $query = mysqli_query($koneksi, "SELECT nama FROM conveyor WHERE username='$conv_name'");
                    $tmp = mysqli_fetch_array($query);
                    $tmp1 = $tmp['nama'];
                ?>
                <h3>Report Problem Conveyor <?php echo $tmp1 ?></h3>
                <div id="clock"></div>
                <br>

                <!-- form problem -->
                <form method="POST" action="reportproblem.php">

                <?php
                    $querygl = mysqli_query($koneksi, "SELECT nik_gl FROM problem WHERE date=CURRENT_DATE() AND conveyor='$tmp1'");
                    $querydata=mysqli_fetch_array($querygl);
                    $querygldata=$querydata['nik_gl'];
                ?>

                <!-- form nik -->
                    <table>
                        <tr> 
                            <td><label for="exampleFormControlInput1">NIK GL&nbsp</label></td>
                            <td><input type="text" class="form-control" name="nik" id="exampleFormControlInput1" placeholder="NIK GL" value="<?php echo $querygldata ?>"></td>
                            <input type="hidden" class="form-control" name="conveyor" value="<?php echo $tmp1 ?>"></<input>
                        </tr>
                    </table>

                <!-- shift kerja -->
                    <br>
                    <label class="spasi">Pilih Shift Kerja <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="A" name="shift" id="inlineRadio1">
                        <label class="form-check-label" for="inlineRadio1">Shift A</label>
                    </div>

                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="B" name="shift" id="inlineRadio2">
                        <label class="form-check-label" for="inlineRadio2">Shift B</label>
                    </div>

                <!-- pilih problem -->
                    <br>
                    <br>
                    <label class="spasi">Pilih Problem <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="Problem Pre Assy" name="check[]" id="inlineRadio3">
                        <label class="form-check-label" for="inlineRadio3">Problem Pre Assy</label>
                    </div>

                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="Problem Final Assy" name="check[]" id="inlineRadio4">
                        <label class="form-check-label" for="inlineRadio4">Problem Final Assy</label>
                    </div>

                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="Problem Gun Clip" name="check[]" id="inlineRadio5">
                        <label class="form-check-label" for="inlineRadio5">Problem Gun Clip</label>
                    </div>

                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="Other NYS" name="check[]" id="inlineRadio6">
                        <label class="form-check-label" for="inlineRadio6">Other NYS</label>
                    </div>


                <!-- keterangan -->
                <br>
                <br>
                    <div class="form-group fieldGroup">
                        <div class="input-group">
                            <input type="text" name="keterangan[]" class="form-control" placeholder="Tambahkan detail problem"/>
                            <div class="input-group-addon"> 
                                <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                            </div>
                        </div>
                    </div>
                    <br>  
                    <div class="col-auto">
                        <button type="submit" name="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                    <!-- copy of input fields group -->
                    <div class="form-group fieldGroupCopy" style="display: none;">
                        <div class="input-group">
                            <input type="text" name="keterangan[]" class="form-control" placeholder="Tambahkan detail problem"/>
                            <div class="input-group-addon"> 
                                <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- akhir form problem -->
            </div>

            <!-- history belum confirm -->
            <div class="col-md-5">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <table class="table table-sm">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kerusakan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Konfirmasi GL</th>
                        </tr>
                    </thead>
                    
                    <?php

                    $query = mysqli_query($koneksi, "SELECT * FROM problem WHERE conveyor='$tmp1'");
                    $nomor=1;
                    foreach($query as $row){
                        if($row['konfirmasi_gl'] == NULL){
                            echo"	
                        <tbody>
                            <tr>
                            <th scope='row'>".$nomor++."</th>
                            <td>".$row['kerusakan']."</td>
                            <td>".$row['keterangan']."</td>
                            <td>";
                                echo'
                                <form action="insertpassgl.php" method="GET">
                                <input type="password" class="form-control" name="pass_gl">';
                                echo"<input type='hidden' class='form-control' name='id' value=$row[id]>";
                                echo"<button type='submit' class='btn-primary mb-2'>Confirm</button>
                                </form>";
                            echo"
                            </td>
                            </tr>
                            </tr>
                        </tbody>";
                        }
                    }
                    ?>
                </table>
            </div>
            <!-- history belum confirm end -->

            <!-- Barcode -->
            <div class="col-md-2">
                <br>
                <br>
                <br>
                <br>
                <br>

                <div>

                <?php
                $querybar=mysqli_query($koneksi, "SELECT qrcode FROM conveyor WHERE nama ='$tmp1'");
                $querybar1=mysqli_fetch_assoc($querybar);

                    $tempdir = "resources/"; //Nama folder tempat menyimpan file qrcode
                    if (!file_exists($tempdir)) //Buat folder bername temp
                    mkdir($tempdir);
        
                    //isi qrcode jika di scan
                    $codeContents = $querybar1['qrcode'];

                    //nama file qrcode yang akan disimpan
                    $namaFile="$conv_name-"."Conveyor "."$tmp1"."-QRCode-".$querybar1['qrcode'].".png";

                    //ECC Level
                    $level=QR_ECLEVEL_H;

                    //Ukuran pixel
                    $UkuranPixel=8;

                    //Ukuran frame
                    $UkuranFrame=4;
        
                    QRcode::png($codeContents, $tempdir.$namaFile, $level, $UkuranPixel, $UkuranFrame); 
        
                    
                    echo '<img src="'.$tempdir.$namaFile.'" />';  
                ?>

                </div>
            </div>
            <!-- Barcode end -->

		</div>
    </div>
    <!-- grid content akhir -->


    <!-- JavaScript -->
    <script src="../jquery/jquery-3.4.1.min.js"></script>
	<script src="../waktu.js"></script>
    <script src="../form.js"></script>

  </body>
</html>