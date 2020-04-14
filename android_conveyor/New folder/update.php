<?php 

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Mendapatkan Nilai Dari Variable 
		$id = $_POST['id'];
		$user_teknisi=$_POST['user_teknisi'];
		
		//$konfirmasi_date = $_POST['konfirmasi_date'];
        $konfirmasi_teknisi = $_POST['konfirmasi_teknisi'];
		
		//import file koneksi database 
		require_once('koneksi.php');
		
		$cari_nama=mysqli_query($con, "SELECT nama FROM teknisi WHERE username='$user_teknisi'");
		$cari_nama1=mysqli_fetch_array($cari_nama);
		$cari_nama2=$cari_nama1['nama'];

		//Membuat SQL Query
		$sql = "UPDATE problem SET konfirmasi_date = now(), konfirmasi_teknisi = 'Terkonfirmasi', nama_teknisi='$cari_nama2' WHERE id = $id;";

		//Mengupdate Database
		if(mysqli_query($con,$sql)){
			echo 'Berhasil Update Konfirmasi Teknisi';
		}else{
			echo 'Gagal Update Konfirmasi Teknisi';
		}

		$cektek=mysqli_query($con, "SELECT konfirmasi_teknisi FROM problem WHERE id='$id'");
		$rowtek = mysqli_fetch_array($cektek);
		$stattek = $rowtek['konfirmasi_teknisi'];

		$cekgl=mysqli_query($con, "SELECT konfirmasi_gl FROM problem WHERE id='$id'");
		$rowgl = mysqli_fetch_array($cekgl);
		$statgl = $rowgl['konfirmasi_gl'];

		$cekjumlahtek=mysqli_num_rows($cektek);

		if($cekjumlahtek == 1){
			$querytek = mysqli_query($con, "UPDATE problem SET status='Belum dikonfirmasi GL' WHERE id='$id'");    
		}

		if($statgl == $stattek){
			$querystatus = mysqli_query($con, "UPDATE problem SET status='Selesai' WHERE id='$id'");

			$querydate = mysqli_query($con, "UPDATE problem SET end_date=now() WHERE id='$id'");
		}
				
		mysqli_close($con);
	}
?>