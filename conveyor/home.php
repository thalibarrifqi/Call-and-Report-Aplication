<!doctype html>

<?php 
    include '../koneksi.php';
    include '../phpqrcode/qrlib.php';
    
    session_start();
    
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['username']==""){
	header("location:../index.php?pesan=gagal");
    }

    if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo '<script type="text/javascript">alert("NIK tidak ditemukan");</script>';
		}
	}else{
        error_reporting(0);
    }
    
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="rating.css">
    
    
    <title>Home</title>
    <link rel="icon" href="../resource/careapp-favicon1.png">
    <script src="../jquery/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="tek_aktif.js"></script>
    <script src="rating.js"></script>

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
		<div class="row mr-lg-5">
            <div class="col-md-2">
                <!-- sidebar -->
                <ul class="nav fixed-top flex-column mt-xl-5 bg-dark h-100" style="width: 13%">
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
                <div class="container bg-white fixed-bottom overflow-auto" style="margin-left: 0; width: 13%; height: 50%">
					<div id="tek_aktif"></div>
				</div>
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
                    $hari=date('d');
                    $bulan=date('m');
                    $tahun=date('Y');
                    $querygl = mysqli_query($koneksi, "SELECT nik_gl, nama_gl FROM problem WHERE DAY(date)='$hari' AND MONTH(date)='$bulan' AND YEAR(date)='$tahun' AND conveyor='$tmp1'");
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
                    <br>
                    <tr>
                        <label><?php echo $querynamagl=$querydata['nama_gl'] ?> </label>
                    </tr>

                <!-- shift kerja -->
                    <br>
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
                                <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                    <input type="radio" id="star5" name="rating_gl" value="5" /><label for="star5" title="5 star"></label>
                                    <input type="radio" id="star4" name="rating_gl" value="4" /><label for="star4" title="4 star"></label>
                                    <input type="radio" id="star3" name="rating_gl" value="3" /><label for="star3" title="3 star"></label>
                                    <input type="radio" id="star2" name="rating_gl" value="2" /><label for="star2" title="2 star"></label>
                                    <input type="radio" id="star1" name="rating_gl" value="1" /><label for="star1" title="1 star"></label>
                                </div>
                                Komentar
                                <input type="text" class="form-control" name="feedback_gl">
                                <br>
                                ';
                                echo'
                                Password
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
                 
                <!--Button Rating  -->
                <center>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Show Rating
                </button>
                </center>
                <!-- EnD of Button Modal -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Rating dari Teknisi</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <div id="rating"></div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>

                    </div>
                  </div>
                  
                </div>

                <!-- End of Modal --> 
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