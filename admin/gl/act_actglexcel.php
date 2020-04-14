<?php 
// menghubungkan dengan koneksi
include '../../koneksi.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>
 
<?php
// upload file xls
$target = basename($_FILES['filegl']['name']) ;
move_uploaded_file($_FILES['filegl']['tmp_name'], $target);
 
// beri permisi agar file xls dapat di baca
chmod($_FILES['filegl']['name'],0777);
 
// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filegl']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);
 
// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
    $nik     = $data->val($i, 1);
    $nama   = $data->val($i, 2);
	
	if($nik != "" && $nama != ""){
		// input data ke database (table data_pegawai)
		mysqli_query($koneksi,"INSERT INTO gl SET nik='$nik', nama='$nama'");
		$berhasil++;
	}
}
 
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filegl']['name']);
 
// alihkan halaman ke index.php
header("location:../gl.php");
?>