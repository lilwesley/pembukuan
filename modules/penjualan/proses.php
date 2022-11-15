<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $kode_pelanggan      = mysqli_real_escape_string($mysqli, trim($_POST['kode_pelanggan']));

            // perintah query untuk menyimpan data ke tabel helm masuk
            $query = mysqli_query($mysqli, "insert into is_pesanan (kode_pelanggan) values ('$kode_pelanggan')");    

            // cek query
           
                // cek query
                if ($query) {                       
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=penjualan&alert=1");
                }
              
        }   
    }
}       
?>