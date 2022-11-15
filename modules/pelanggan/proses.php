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
            $kode_pelanggan  = mysqli_real_escape_string($mysqli, trim($_POST['kode_pelanggan']));
            $nama_pelanggan  = mysqli_real_escape_string($mysqli, trim($_POST['nama_pelanggan']));
            $telepon         = mysqli_real_escape_string($mysqli, trim($_POST['telepon']));
            $alamat          = mysqli_real_escape_string($mysqli, trim($_POST['alamat']));

            // perintah query untuk menyimpan data ke tabel obat
            $query = mysqli_query($mysqli, "INSERT INTO is_pelanggan(kode_pelanggan,nama_pelanggan,telepon,alamat) 
                                            VALUES('$kode_pelanggan','$nama_pelanggan','$telepon','$alamat')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=pelanggan&alert=1");
            }   
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['kode_pelanggan'])) {
                // ambil data hasil submit dari form
                $kode_pelanggan  = mysqli_real_escape_string($mysqli, trim($_POST['kode_pelanggan']));
                $nama_pelanggan  = mysqli_real_escape_string($mysqli, trim($_POST['nama_pelanggan']));
                $telepon         = mysqli_real_escape_string($mysqli, trim($_POST['telepon']));
                $alamat          = mysqli_real_escape_string($mysqli, trim($_POST['alamat']));

                // perintah query untuk mengubah data pada tabel obat
                $query = mysqli_query($mysqli, "UPDATE is_pelanggan SET  nama_pelanggan       = '$nama_pelanggan',
                                                                    telepon      = '$telepon',
                                                                    alamat      = '$alamat'
                                                                    
                                                              WHERE kode_pelanggan       = '$kode_pelanggan'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=pelanggan&alert=2");
                }         
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $kode_pelanggan = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel obat
            $query = mysqli_query($mysqli, "DELETE FROM is_pelanggan WHERE kode_pelanggan='$kode_pelanggan'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=pelanggan&alert=3");
            }
        }
    }       
}       
?>