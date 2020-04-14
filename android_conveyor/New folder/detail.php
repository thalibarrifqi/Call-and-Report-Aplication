<?php 
	$id = $_GET['id'];
	
	//Importing database
	require_once('koneksi.php');
	
	//Membuat SQL Query dengan pegawai yang ditentukan secara spesifik sesuai ID
	$sql = "SELECT problem.id, problem.conveyor, problem.nama_validasi, problem.nama_teknisi, problem.kerusakan, problem.keterangan, problem.status, problem.start_date, problem.scan_date, problem.konfirmasi_date, problem.konfirmasi_teknisi, conveyor.qrcode FROM problem LEFT JOIN conveyor ON problem.conveyor = conveyor.nama WHERE problem.id='$id'";
	
	//Mendapatkan Hasil 
	$r = mysqli_query($con,$sql);
	
	//Memasukkan Hasil Kedalam Array
	$result = array();
	$row = mysqli_fetch_array($r);
	array_push($result,array(
        "id"=>$row['id'],
		"conveyor"=>$row['conveyor'],
		"nama_teknisi"=>$row['nama_teknisi'],
		"nama_validasi"=>$row['nama_validasi'],
        "kerusakan"=>$row['kerusakan'],
        "keterangan"=>$row['keterangan'],
        "status"=>$row['status'],
        "start_date"=>$row['start_date'],
        "scan_date"=>$row['scan_date'],
        "konfirmasi_date"=>$row['konfirmasi_date'],
		"konfirmasi_teknisi"=>$row['konfirmasi_teknisi'],
		"qrcode"=>$row['qrcode']
		));

	//Menampilkan dalam format JSON
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
?>
