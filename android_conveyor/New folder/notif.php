<?php 

	//Import File Koneksi Database
	require_once('koneksi.php');
	
	//Membuat SQL Query
	$sql = "SELECT * FROM problem where status != 'Selesai' AND date=CURRENT_DATE()";
	//Mendapatkan Hasil
	$r = mysqli_query($con,$sql);
	
	//menghitung jumlah id
	
	$jumlahBaru = mysqli_num_rows($r);
	$jumlahLama = 0;

	if($jumlahBaru > $jumlahLama)
	{
		//echo json_encode($jumlahBaru);
		$jumlahLama++;
	} 
	
	//Membuat Array Kosong 
	$result = array();
	while($row = mysqli_fetch_array($r)){
		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
		array_push($result,array(
			"id"=>$row['id'],
            		"conveyor"=>$row['conveyor'],
            		"kerusakan"=>$row['kerusakan'],
            		"keterangan"=>$row['keterangan']
		));
	}
	
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
?>