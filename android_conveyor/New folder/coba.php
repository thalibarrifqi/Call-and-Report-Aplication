<?php 

	//Import File Koneksi Database
	require_once('koneksi.php');
	$username = $_GET['username'];
	//Membuat SQL Query
	$sql = "SELECT nama FROM teknisi WHERE username='$username'";
	//Mendapatkan Hasil
	$r = mysqli_query($con,$sql);
	//Membuat Array Kosong 
	$result = array();
	while($row = mysqli_fetch_array($r)){
		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
		array_push($result,array(
			"nama"=>$row['nama']
		));
	}
	
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
?>