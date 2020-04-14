package com.example.ekybintarnow.bottomnavigationview;

/**
 * Created by ekybintarnow on 10/02/2020.
 */

class konfigurasi
{
    static final String URL_GET_ALL = "http://192.168.10.102/android_conveyor/show.php";
    static final String URL_GET_EMP = "http://192.168.10.102/android_conveyor/detail.php?id=";
    static final String URL_UPDATE_EMP = "http://192.168.10.102/android_conveyor/update.php";
    static final String URL_UPDATE_SCAN = "http://192.168.10.102/android_conveyor/scan.php";
    static final String URL_HISTORY = "http://192.168.10.102/android_conveyor/history.php";
    static final String URL_GET_DETAIL_HISTORY = "http://192.168.10.102/android_conveyor/detail_history.php?id=";
    static final String URL_RATING = "http://192.168.10.102/android_conveyor/rating.php";
    static final String URL_UPDATE_NOTIFIKASI = "http://192.168.10.102/android_conveyor/click_date.php";


    //10.62.230.186

    //Dibawah ini merupakan Kunci yang akan digunakan untuk mengirim permintaan ke Skrip PHP
    static final String KEY_EMP_ID = "id";
    static final String KEY_EMP_TEKNISI = "user_teknisi"; //desg itu variabel untuk posisi
    static final String KEY_EMP_SCAN_DATE = "scan_date"; //salary itu variabel untuk gajih
    static final String KEY_EMP_KONFIRMASI_DATE = "konfirmasi_date";
    static final String KEY_EMP_KONFIRMASI_TEKNISI = "konfirmasi_teknisi";
    static final String KEY_EMP_RATING_VALUE = "rating_teknisi";
    static final String KEY_EMP_FEEDBACK_VALUE = "feedback_teknisi";
    static final String KEY_EMP_OPEN_TEKNISI= "nama_klik";
    static final String KEY_EMP_VALIDASI_TEKNISI= "nama_validasi";


    //JSON Tags
    static final String TAG_JSON_ARRAY="result";
    static final String TAG_ID = "id";
    static final String TAG_CONVEYOR = "conveyor";
    static final String TAG_KERUSAKAN = "kerusakan";
    static final String TAG_KETERANGAN = "keterangan";
    static final String TAG_STATUS = "status";
    static final String TAG_START_DATE = "start_date";
    static final String TAG_END_DATE = "end_date";
    static final String TAG_SCAN_DATE = "scan_date";
    static final String TAG_KONFIRMASI_DATE = "konfirmasi_date";
    static final String TAG_KONFIRMASI_TEKNISI = "konfirmasi_teknisi";
    static final String TAG_QRCODE = "qrcode";
    static final String TAG_TEKNISI = "nama_teknisi";
    static final String TAG_RATING_TEKNISI = "rating_teknisi";
    static final String TAG_FEEDBACK_TEKNISI = "feedback_teknisi";
    static final String TAG_KLIK_TEKNISI = "nama_klik";
    static final String TAG_NAMA_VALIDASI = "nama_validasi";
    static final String TAG_RATING_GL = "rating_gl";
    static final String TAG_FEEDBACK_GL = "feedback_gl";
    static final String TAG_NIK = "nik";
    static final String TAG_NAMA = "nama";

    //ID karyawan
    //emp itu singkatan dari Employee
    static final String PBM_ID = "pbm_id";
}
