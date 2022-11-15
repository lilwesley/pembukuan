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
            $kode_transaksi = mysqli_real_escape_string($mysqli, trim($_POST['kode_transaksi']));
            
            $tanggal         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_masuk']));
            $exp             = explode('-',$tanggal);
            $tanggal_masuk   = $exp[2]."-".$exp[1]."-".$exp[0];
            
            $kode_helm       = mysqli_real_escape_string($mysqli, trim($_POST['kode_barang']));
            $jumlah_masuk    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_masuk']));
            $total_stok      = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));  
            $harga_beli      = mysqli_real_escape_string($mysqli, trim($_POST['harga_beli']));  
            $total_harga_beli = mysqli_real_escape_string($mysqli, trim($_POST['total_harga_beli']));
            
            $created_user    = $_SESSION['id_user'];
            /*$harga_beli      = mysqli_real_escape_string($mysqli, trim($_POST['harga_beli']));*/

            // perintah query untuk menyimpan data ke tabel helm masuk
            $query = mysqli_query($mysqli, "INSERT INTO is_barang_masuk(kode_transaksi,tanggal_masuk,kode_barang,jumlah_masuk,created_user,harga_beli,total_harga_beli) 
                                            VALUES('$kode_transaksi','$tanggal_masuk','$kode_helm','$jumlah_masuk','$created_user','$harga_beli','$total_harga_beli')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // perintah query untuk mengubah data pada tabel helm
                $query1 = mysqli_query($mysqli, "UPDATE is_barang SET stok        = '$total_stok'
                                                              WHERE kode_barang   = '$kode_helm'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query1) {                       
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=barang_masuk&alert=1");
                }
            }   
        }   
    }
}       
?>