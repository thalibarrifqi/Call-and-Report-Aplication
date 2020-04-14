<?php 
// menghubungkan dengan koneksi
include '../../koneksi.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>
 
<?php
// upload file xls
$target = basename($_FILES['filecon']['name']) ;
move_uploaded_file($_FILES['filecon']['tmp_name'], $target);
 
// beri permisi agar file xls dapat di baca
chmod($_FILES['filecon']['name'],0777);
 
// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filecon']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);
 
// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$username     = $data->val($i, 1);
    $password   = $data->val($i, 2);
	$nama   = $data->val($i, 3);

	$qrcode=mt_rand(10000, 2147483647);
    
	if($username != "" && $password != "" &&  $nama != ""){
		// input data ke database (table data_pegawai)
		mysqli_query($koneksi,"INSERT INTO conveyor SET username='$username', nama='$nama', password='$password', qrcode='$qrcode'");
		$berhasil++;
	}
}
 
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filecon']['name']);
 
// alihkan halaman ke index.php
header("location:../conveyor.php");
?>