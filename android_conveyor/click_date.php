<?php 
	if($_SERVER['REQUEST_METHOD']=='POST'){
        $id = $_POST['id'];
        $nama_klik = $_POST['nama_klik'];
        
        require_once('koneksi.php');

        $cari_nama=mysqli_query($con, "SELECT nama FROM teknisi WHERE username='$nama_klik'");
		$cari_nama1=mysqli_fetch_array($cari_nama);
		$cari_nama2=$cari_nama1['nama'];

        $sql = "UPDATE problem SET click_date =now(), nama_klik='$cari_nama2' WHERE id = '$id' AND click_date =''";
        mysqli_query($con, $sql);

        mysqli_close($con);
	}
?>