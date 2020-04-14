<?php
	// januari
	$queryjanpre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '01' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$datajanpre = mysqli_num_rows($queryjanpre);

	$queryjanfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '01' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$datajanfin = mysqli_num_rows($queryjanfin);

	$queryjangun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '01' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$datajangun = mysqli_num_rows($queryjangun);

	$queryjanoth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '01' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $datajanoth = mysqli_num_rows($queryjanoth);
		
	// Februari
	$queryfebpre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '02' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$datafebpre = mysqli_num_rows($queryfebpre);

	$queryfebfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '02' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$datafebfin = mysqli_num_rows($queryfebfin);

	$queryfebgun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '02' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$datafebgun = mysqli_num_rows($queryfebgun);

	$queryfeboth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '02' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $datafeboth = mysqli_num_rows($queryfeboth);
	
	// maret
	$querymarpre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '03' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$datamarpre = mysqli_num_rows($querymarpre);

	$querymarfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '03' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$datamarfin = mysqli_num_rows($querymarfin);

	$querymargun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '03' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$datamargun = mysqli_num_rows($querymargun);

	$querymaroth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '03' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $datamaroth = mysqli_num_rows($querymaroth);
	
	// april
	$queryappre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '04' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$dataappre = mysqli_num_rows($queryappre);

	$queryapfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '04' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$dataapfin = mysqli_num_rows($queryapfin);

	$queryapgun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '04' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$dataapgun = mysqli_num_rows($queryapgun);

	$queryapoth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '04' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $dataapoth = mysqli_num_rows($queryapoth);

	// mei
	$querymeipre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '05' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$datameipre = mysqli_num_rows($querymeipre);

	$querymeifin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '05' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$datameifin = mysqli_num_rows($querymeifin);

	$querymeigun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '05' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$datameigun = mysqli_num_rows($querymeigun);

	$querymeioth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '05' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $datameioth = mysqli_num_rows($querymeioth);	
	
	// juni
	$queryjunpre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '06' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$datajunpre = mysqli_num_rows($queryjunpre);

	$queryjunfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '06' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$datajunfin = mysqli_num_rows($queryjunfin);

	$queryjungun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '06' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$datajungun = mysqli_num_rows($queryjungun);

	$queryjunoth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '06' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $datajunoth = mysqli_num_rows($queryjunoth);

	// juli
	$queryjulpre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '07' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$datajulpre = mysqli_num_rows($queryjulpre);

	$queryjulfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '07' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$datajulfin = mysqli_num_rows($queryjulfin);

	$queryjulgun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '07' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$datajulgun = mysqli_num_rows($queryjulgun);

	$queryjuloth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '07' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $datajuloth = mysqli_num_rows($queryjuloth);

	// agustus
	$queryagupre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '08' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$dataagupre = mysqli_num_rows($queryagupre);

	$queryagufin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '08' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$dataagufin = mysqli_num_rows($queryagufin);

	$queryagugun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '08' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$dataagugun = mysqli_num_rows($queryagugun);

	$queryaguoth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '08' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $dataaguoth = mysqli_num_rows($queryaguoth);

	// september
	$queryseppre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '09' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$dataseppre = mysqli_num_rows($queryseppre);

	$querysepfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '09' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$datasepfin = mysqli_num_rows($querysepfin);

	$querysepgun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '09' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$datasepgun = mysqli_num_rows($querysepgun);

	$querysepoth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '09' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $datasepoth = mysqli_num_rows($querysepoth);

	// oktober	
	$queryokpre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '10' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$dataokpre = mysqli_num_rows($queryokpre);

	$queryokfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '10' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$dataokfin = mysqli_num_rows($queryokfin);

	$queryokgun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '10' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$dataokgun = mysqli_num_rows($queryokgun);

	$queryokoth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '10' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $dataokoth = mysqli_num_rows($queryokoth);

	// november
	$querynovpre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '11' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$datanovpre = mysqli_num_rows($querynovpre);

	$querynovfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '11' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$datanovfin = mysqli_num_rows($querynovfin);

	$querynovgun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '11' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$datanovgun = mysqli_num_rows($querynovgun);

	$querynovoth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '11' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $datanovoth = mysqli_num_rows($querynovoth);

	// desember
	$querydespre = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '12' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Pre Assy'");
	$datadespre = mysqli_num_rows($querydespre);

	$querydesfin = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '12' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Final Assy'");
	$datadesfin = mysqli_num_rows($querydesfin);

	$querydesgun = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '12' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Problem Gun Clip'");
	$datadesgun = mysqli_num_rows($querydesgun);

	$querydesoth = mysqli_query($koneksi, "SELECT id FROM problem WHERE MONTH(date) = '12' AND YEAR(date) = YEAR(CURRENT_DATE()) AND kerusakan='Other NYS'");
    $datadesoth = mysqli_num_rows($querydesoth);
?>