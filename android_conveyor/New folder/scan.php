<?php 

	if($_SERVER['REQUEST_METHOD']=='POST'){
		//Mendapatkan Nilai Dari Variable 
		$id = $_POST['id'];
        $scan_date = $_POST['scan_date'];
        $nama_validasi = $_POST['nama_validasi'];
		
		//import file koneksi database 
        require_once('koneksi.php');

        $cari_nama=mysqli_query($con, "SELECT nama FROM teknisi WHERE username='$nama_validasi'");
		$cari_nama1=mysqli_fetch_array($cari_nama);
		$cari_nama2=$cari_nama1['nama'];
        
        $sql = "UPDATE problem SET scan_date =now(), nama_validasi='$cari_nama2' WHERE id = '$id'";		

        if(mysqli_query($con,$sql)){
			echo 'Berhasil Update Scan Date';
		}else{
			echo 'Gagal Update Scan Date';
        }
        
		mysqli_close($con);
	}
?>