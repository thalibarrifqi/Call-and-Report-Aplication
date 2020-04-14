<?php 

	//Import File Koneksi Database
	require_once('koneksi.php');
	
	//Membuat SQL Query
	$sql = "SELECT * FROM problem WHERE status = 'Selesai' AND MONTH(date)=MONTH(CURRENT_DATE()) ORDER BY end_date ASC";
	//Mendapatkan Hasil
	$r = mysqli_query($con,$sql);
	//Membuat Array Kosong 
	$result = array();
	while($row = mysqli_fetch_array($r)){
		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
		array_push($result,array(
			"id"=>$row['id'],
            "conveyor"=>$row['conveyor'],
            "kerusakan"=>$row['kerusakan'],
            "keterangan"=>$row['keterangan'],
            "status"=>$row['status'],
			"end_date"=>$row['end_date'],
			"rating_teknisi"=>$row['rating_teknisi']
		));
	}
	
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
?>