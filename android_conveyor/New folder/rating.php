<?php 

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Mendapatkan Nilai Dari Variable 
		$id = $_POST['id'];
        $feedback_teknisi=$_POST['feedback_teknisi'];
        $rating_teknisi=$_POST['rating_teknisi'];
		
		//import file koneksi database 
		require_once('koneksi.php');
		
		//Membuat SQL Query
		$sql = "UPDATE problem SET feedback_teknisi = '$feedback_teknisi', rating_teknisi = '$rating_teknisi'  WHERE id = $id";

		//Mengupdate Database
		if(mysqli_query($con,$sql)){
			echo 'Feedback ke GL Terkirim';
		}else{
			echo 'Gagal memberikan feedback';
		}
				
		mysqli_close($con);
	}
?>