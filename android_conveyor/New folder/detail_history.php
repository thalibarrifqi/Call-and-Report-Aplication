<?php 
	$id = $_GET['id'];
	//Importing database
	require_once('koneksi.php');
	
	//Membuat SQL Query dengan pegawai yang ditentukan secara spesifik sesuai ID
	$sql = "SELECT problem.id, problem.conveyor, problem.feedback_teknisi, problem.rating_teknisi, problem.feedback_gl, problem.rating_gl, problem.nama_teknisi, problem.kerusakan, problem.keterangan FROM problem LEFT JOIN conveyor ON problem.conveyor = conveyor.nama WHERE problem.id='$id'";
	
	//Mendapatkan Hasil 
	$r = mysqli_query($con,$sql);
	
	//Memasukkan Hasil Kedalam Array
	$result = array();
	$row = mysqli_fetch_array($r);
	array_push($result,array(
        "id"=>$row['id'],
		"conveyor"=>$row['conveyor'],
		"nama_teknisi"=>$row['nama_teknisi'],
        "kerusakan"=>$row['kerusakan'],
		"keterangan"=>$row['keterangan'],
		"rating_teknisi"=>$row['rating_teknisi'],
		"feedback_teknisi"=>$row['feedback_teknisi'],
		"rating_gl"=>$row['rating_gl'],
		"feedback_gl"=>$row['feedback_gl']
		));

	//Menampilkan dalam format JSON
	echo json_encode(array('result'=>$result));	
	mysqli_close($con);
?>