<!doctype html>

<?php
	include '../koneksi.php';
	include 'bulan.php';
	include 'kerusakan.php';

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
	<script src="../js/bootstrap.min.js"></script>
	<script src="../chartjs/Chart.js"></script>
	<script src="conv_aktif.js"></script>
	<script src="../chartjs/chartjs-plugin-datalabels.min.js"></script>
	<script src="conv_prob.js"></script>
	<script src="juml_prob.js"></script>
	<script src="prob_sel.js"></script>
	<script src="button_conv_prob.js"></script>
	<script src="modal_conv_aktif.js"></script>
	<script src="datajumlah.js"></script>
	<script src="todays_problem.js"></script>
	<script src="todays_fix.js"></script>
	<script src="teknisi_aktif.js"></script>
	<!-- <script src="tek_login.js"></script> -->
	<script src="tek_aktif.js"></script>

    <title>Dashboard</title>
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
                    </li>
					<li class="nav-item">
						<img src="resource/icons8-glue-gun.png">
                        <a class="btn btn-dark" href="gunclip/gunclip.php">Gunclip</a>
                    </li> -->
				</ul>
				<!-- end sidebar -->
				<div class="container bg-white fixed-bottom overflow-auto" style="margin-left: 0; width: 13%; height: 40%">
					<div id="tek_aktif"></div>
				</div>
			</div>
			

			<div class="col-md-10">
				<br>
				<br>
				<br>
				<h3>Dashboard</h3>
				<br>
				<div class="container-fluid">
				<!-- card info -->
					<div class="row">

						<div class="col-sm">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">
								Conveyor Aktif<br>
								<span class="badge badge-light">
								<div style="font-size: 15pt" id="conv_aktif"></div>
								</span>
							</button>
						</div>

						<!-- Modal -->
						<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="staticBackdropLabel">Conveyor Aktif</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
									</div>
									<div class="modal-body">
										<!-- list conveyor aktif -->
										<div id="modal_conv_aktif"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm">
							<button type="button" class="btn btn-info">
								Conveyor Bermasalah<br> 
								<span class="badge badge-light">
								<div style="font-size: 15pt" id="conv_prob"></div>
								</span>
							</button>
						</div>

						<div class="col-sm">
							<button type="button" class="btn btn-info" data-toggle='modal' data-target='#modalProblem'>
								Panggilan Hari Ini<br> 
								<span class="badge badge-light">
								<div style="font-size: 15pt" id="juml_prob"></div>
								</span>
							</button>
						</div>

						<!-- Modal kerusakan hari ini -->
						<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalProblem">
							<div class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="staticBackdropLabel">Problem Hari ini</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
									</div>
									<div class="modal-body">
										<!-- list masalah pada conveyor -->
										<div id="todays_problem"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalFix">
								Selesai Diperbaiki<br> 
								<span class="badge badge-light">
								<div style="font-size: 15pt" id="prob_sel"></div>
								</span>
							</button>
						</div>

						<!-- Modal problem fix -->
						<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalFix">
							<div class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="staticBackdropLabel">Problem Selesai</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
									</div>
									<div class="modal-body">
										<!-- list masalah selesai -->
										<div id="todays_fix"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Conveyor bermasalah -->

					<!-- <br> -->
					<!-- <div class="row"> -->
						<!-- <div class="col-sm"> -->
							<!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalTek">
								Teknisi Aktif &nbsp<span class="badge badge-light">
									<div id="teknisi_aktif"></div>
								</span>
							</button>								 -->
						<!-- </div> -->
						<!-- <div class="col-sm-10"> -->
						<!-- <br>
						
							<div id="tek_aktif"></div>
						</div> -->
					<!-- </div> -->
	
					<!-- teknisi -->
					<!-- <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalTek">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="staticBackdropLabel">Teknisi Login</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
									</div>
									<div class="modal-body">

										<div id="tek_login"></div>
									</div>
								</div>
							</div>
						</div> -->
					
					<div class="row">
						<div class="col-sm">
							<br>
							<h5>Conveyor Bermasalah</h5>
							<div id="button_conv_prob"> </div>
						</div>
					</div>
					<!-- akhir conveyor bermasalah -->

				<!-- card info end -->

				<!-- grafik -->
				<br>
				<br>
				<div class="row">
					<div class="col-lg">
						<div style="text-align: center">
							<h5>Jumlah Panggilan Per Bulan</h5>
						</div>
						<div style="position: relative; height:50vh; width:40vw">
							<canvas id="myChart"></canvas>
						</div>
					</div>
					<div class="col-lg">
						<div style="margin-left: 25px">
							<h5>Jumlah Panggilan Berdasarkan Proses Produksi</h5>
						</div>
						<div style="position: relative; height:40vh; width:35vw">
							<canvas id="myChart1"></canvas>
						</div>
					</div>
				</div>

				<script>


				var ctx = document.getElementById('myChart');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
						datasets: [{
						label: "Pre Assy",
						type: "bar",
						stack: "Base",
						backgroundColor: "#ec008c",
						data: [  
								<?php echo $datajulpre; ?>, 
								<?php echo $dataagupre; ?>, 
								<?php echo $dataseppre; ?>,
								<?php echo $dataokpre; ?>,
								<?php echo $datanovpre; ?>,
								<?php echo $datadespre; ?>,
								<?php echo $datajanpre; ?>, 
								<?php echo $datafebpre; ?>, 
								<?php echo $datamarpre; ?>, 
								<?php echo $dataappre; ?>, 
								<?php echo $datameipre; ?>, 
								<?php echo $datajunpre; ?>
								],
						}, 
						{
						label: "Final Assy",
						type: "bar",
						stack: "Base",
						backgroundColor: "#fad640",
						data: [  
								<?php echo $datajulfin; ?>, 
								<?php echo $dataagufin; ?>, 
								<?php echo $datasepfin; ?>,
								<?php echo $dataokfin; ?>,
								<?php echo $datanovfin; ?>,
								<?php echo $datadesfin; ?>,
								<?php echo $datajanfin; ?>, 
								<?php echo $datafebfin; ?>, 
								<?php echo $datamarfin; ?>, 
								<?php echo $dataapfin; ?>, 
								<?php echo $datameifin; ?>, 
								<?php echo $datajunfin; ?>
								],
						}, 
						{
						label: "Gun Clip",
						type: "bar",
						stack: "Base",
						backgroundColor: "#c5cc33",      
						data: [ 
								<?php echo $datajulgun; ?>, 
								<?php echo $dataagugun; ?>, 
								<?php echo $datasepgun; ?>,
								<?php echo $dataokgun; ?>,
								<?php echo $datanovgun; ?>,
								<?php echo $datadesgun; ?>,
								<?php echo $datajangun; ?>, 
								<?php echo $datafebgun; ?>, 
								<?php echo $datamargun; ?>, 
								<?php echo $dataapgun; ?>, 
								<?php echo $datameigun; ?>, 
								<?php echo $datajungun; ?>
								],
						}, 
						{
						label: "Other NYS",
						type: "bar",
						stack: "Base",
						backgroundColor: "#00aeef",
						data: [  
								<?php echo $datajuloth; ?>, 
								<?php echo $dataaguoth; ?>, 
								<?php echo $datasepoth; ?>,
								<?php echo $dataokoth; ?>,
								<?php echo $datanovoth; ?>,
								<?php echo $datadesoth; ?>,
								<?php echo $datajanoth; ?>, 
								<?php echo $datafeboth; ?>, 
								<?php echo $datamaroth; ?>, 
								<?php echo $dataapoth; ?>, 
								<?php echo $datameioth; ?>, 
								<?php echo $datajunoth; ?>
								]
						}]
					},
					options: {
						legend : {
							display: true,
							// display: false,
							position: 'top'
						},
						plugins: {
							datalabels: {
								color: 'black',
								font: {
									size: '14',
									family: 'Helvetica'
								},
								display: function(context) {
								var index = context.dataIndex;
								var value = context.dataset.data[index];
								return value > 0; // display labels with a value greater than 0
								}
							}
						},
						scales: {
							xAxes: [{
								//stacked: true,
								stacked: true,
								ticks: {
								maxRotation: 45,
								minRotation: 45
								}
							}],
							yAxes: [{
								stacked: true,
								ticks:{
									beginAtZero: true,
									stepSize: 10
								}
							}]
						},
						animation: {
							onComplete: function() {
							var chartInstance = this.chart;
							var ctx = chartInstance.ctx;
							ctx.textAlign = "center";
							ctx.font = "18px Helvetica";

								// draw total count
								this.data.datasets[0].data.forEach(function(data, index) {
								var total = data + this.data.datasets[1].data[index] + this.data.datasets[2].data[index]+this.data.datasets[3].data[index];
								var meta = chartInstance.controller.getDatasetMeta(3);
								var posX = meta.data[index]._model.x;
								var posY = meta.data[index]._model.y;

								ctx.fillStyle = "black";
								ctx.fillText(total, posX, posY-10);
								}, this);
							}
						}
					}
				});
				</script>

				<script>
				var ctx1 = document.getElementById('myChart1');
				var myChart1 = new Chart(ctx1, {
					type: 'pie',
					data: {
						labels: ['Pre Assy', 'Final Assy', 'Gun Clip', 'Other NYS'],
						datasets: [{
							data: [
								<?php echo $datapre; ?>, 
								<?php echo $datafin; ?>, 
								<?php echo $datagun; ?>,
								<?php echo $dataoth; ?>
							],
							backgroundColor: [
								'rgba(195, 26, 127, 1)',
								'rgba(250, 214, 64, 1)',
								'rgba(197, 204, 51, 1)',
								'rgba(0, 174, 239, 1)'
							]
						}]
					},
					options: {
						legend: {
							display: true,
							position: 'top'
						},
						plugins: {
							datalabels: {
								color: 'black',
								font: {
									size: '24',
									family: 'Helvetica'
								}
							}
						}
					}
				});
				</script>
				<!-- grafik end -->
				
				</div>
			</div>			
		</div>
	</div>
	<script>
	function timedRefresh(timeoutPeriod) {
		setTimeout("location.reload(true);",timeoutPeriod);
	}
	window.onload = timedRefresh(240000);
	</script>
  </body>
</html>