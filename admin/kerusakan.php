<?php
	// pre assy
	$querypre = mysqli_query($koneksi, "SELECT id FROM problem WHERE kerusakan = 'Problem Pre Assy' AND MONTH(date)=MONTH(CURRENT_DATE()) AND YEAR(date)=YEAR(CURRENT_DATE())");
    $datapre = mysqli_num_rows($querypre);
		
	// final assy
	$queryfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE kerusakan = 'Problem Final Assy' AND MONTH(date)=MONTH(CURRENT_DATE()) AND YEAR(date)=YEAR(CURRENT_DATE())");
    $datafin = mysqli_num_rows($queryfin);
	
	// gun clip
	$querygun = mysqli_query($koneksi, "SELECT id FROM problem WHERE kerusakan = 'Problem Gun Clip' AND MONTH(date)=MONTH(CURRENT_DATE()) AND YEAR(date)=YEAR(CURRENT_DATE())");
	$datagun = mysqli_num_rows($querygun);
	
	// other NYS
	$queryoth = mysqli_query($koneksi, "SELECT id FROM problem WHERE kerusakan = 'Other NYS' AND MONTH(date)=MONTH(CURRENT_DATE()) AND YEAR(date)=YEAR(CURRENT_DATE())");
	$dataoth = mysqli_num_rows($queryoth);
?>