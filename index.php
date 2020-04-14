<html>

<?php
  include 'koneksi.php';
  if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo '<script type="text/javascript">alert("Gagal masuk, silahkan login kembali");</script>';
		}
	}
?>

<head>
  <title>Halaman Login</title>
  <script src="jquery/jquery-3.4.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="login.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="icon" href="resource/careapp-favicon1.png">
</head>

<body>
  <!--Header-->
  <div class="header fixed-top">
      <div class="container fixed-top">
        <h1 class="warna_tulisan_header"><center>PT. Jatim Autocomp Indonesia</center></h1>
      </div>
  </div>
  <!--End of Header-->

  <!-- Content -->
  <div class="body">

    <div class="jumbotron kotak_isms mt-3">
      <center><h4>ACTIVITY ISMS 5 ITEM</h4></center>
      <br>
      <h6>
        <?php
        $hari=date('N');
        if($hari=='1'){
          echo'
          <b>ACTIVITY ISMS POIN 1</b><br>
          Dilarang mengambil foto/gambar di semua area kerja, baik di <i>office</i> maupun di area Produksi/ tanpa izin SPV PIC area yang difoto,
          serta tidak boleh <i>sharing</i> atau <i>upload</i> ke <i>Social Media</i>
          ';
        }else if($hari=='2'){
          echo'
          <b>ACTIVITY ISMS POIN 2</b><br>
          a. Dilarang menuliskan <i>Project Code</i> bersamaan dengan <i>Car Name</i>, gambar mobil dan <i>Schedule Maspro</i><br>
          b. Dilarang menggunakan USB pribadi, USB yang boleh digunakan hanya yang terdaftar di Perusahaan
          ';
        }else if($hari=='3'){
          echo'
          <b>ACTIVITY ISMS POIN 3</b><br>
          Dilarang membocorkan informasi, kerahasiaan Perusahaan dan data pribadi, seperti: <br>
          a. Dilarang menuliskan komentar mengenai tanggal <i>launching</i> nama mobil dan kode <i>project</i> pada foto mobil yang diposting di internet<br>
          b. Dilarang mengambil foto di area pabrik dan memprosting ke <i>Social Media</i><br>
          c. Segera dihapus dan melapor ke atasan jika terlanjur memposting jadwal <i>mass pro</i> di <i>Social Media</i><br>
          d. GDPR <i>(General Data Protection Regulation)</i><br>
            Dilarang memberitahukan Informasi Pribadi Rekan Kerja, Atasan atau Tamu dari negara Eropa pada orang lain yang tidak berkepentingan atau tidak dikenal,
            baik secara langsung ataupun melalui telepon
          ';
        }else if($hari=='4'){
          echo'
          <b>ACTIVITY ISMS POIN 4</b><br>
          Dampak negatif jika Informasi <i>Schedule Mass Pro</i> mobil baru bocor : <br>
          a. Penjualan mobil yang ada sekarang menjadi berkurang <br>
          b. Pesanan <i>Harness</i> mobil yang ada sekarang menjadi berkurang <br>
          c. Hilangnya kepercayaan dari <i>Customer</i> dan hilangnya pesanan
          ';
        }else if($hari=='5'){
          echo'
          <b>ACTIVITY ISMS POIN 5</b><br>
          Jika melakukan pelanggaran ISMS, maka sanksi yang didapat adalah sesuai dengan tingkat pelanggarannya yang terberat adalah SP 3 (Surat Peringatan ke 3)
          atau PHK (Pemutusan Hubungan Kerja)
          ';
        }
        ?>        

      </h6>
    </div>

    <div class="kotak_login">
      <center>
        <img src="resource/LOGO JAI.png" width="210.616" height="52.11">
        <img src="admin/resource/logoapp.png" width="90" height="90">
      </center>
    <form action="cek_login.php" method="post">
      <br>
      <input type="text" name="username" class="form_login" placeholder="Username..." required="required">

      <br>
      <input type="password" name="password" class="form_login" placeholder="Password..." required="required">

      <br>
      <center>
      <input type="submit" class="tombol_login" value="LOGIN">
      </center>
      <br/>
      <br/>
    </form>
    </div>
  </div>
  <!-- end content -->

</body>

<!--Footer-->
<footer class="footer fixed-bottom">
  <center>
  <p class="tulisan_footer">
      Jalan Wonoayu Nomor 26 <br>
      Pasuruan, Jawa Timur <br>
      Telp. (0343) 850921 
  </p>
  </center>
</footer>
<!--End of Form Input-->

</html>