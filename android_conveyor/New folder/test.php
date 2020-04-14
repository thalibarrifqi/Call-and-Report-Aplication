<?php 

	//Import File Koneksi Database
	require_once('koneksi.php');
	$tanggal = $_GET['tanggal'];
	//Membuat SQL Query
	$sql = "SELECT DISTINCT screw_cutter, upper_lower FROM data_baru WHERE tanggal = '$tanggal'";
	//Mendapatkan Hasil
	$r = mysqli_query($con,$sql);
	//Membuat Array Kosong 
	$result = array();
	while($row = mysqli_fetch_array($r)){
		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
		array_push($result,array(
			"screw_cutter"=>$row['screw_cutter'],
            "upper_lower"=>$row['upper_lower']
		));
	}
	
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
?>