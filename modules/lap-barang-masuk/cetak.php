<?php
session_start();
ob_start();
// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
// panggil fungsi untuk format tanggal
include "../../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../../config/fungsi_rupiah.php";
$hari_ini = date("d-m-Y");
// ambil data hasil submit dari form
$tgl1     = $_GET['tgl_awal'];
$explode  = explode('-',$tgl1);
$tgl_awal = $explode[2]."-".$explode[1]."-".$explode[0];
$tgl2      = $_GET['tgl_akhir'];
$explode   = explode('-',$tgl2);
$tgl_akhir = $explode[2]."-".$explode[1]."-".$explode[0];
if (isset($_GET['tgl_awal'])) {
$no    = 1;
/*$totalharga = 0;*/
// fungsi query untuk menampilkan data dari tabel Helm masuk
$query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_masuk,a.kode_barang,a.jumlah_masuk,a.total_harga_beli,a.harga_beli,b.kode_barang,b.nama_barang,b.satuan
FROM is_barang_masuk as a INNER JOIN is_barang as b ON a.kode_barang=b.kode_barang
WHERE a.tanggal_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir'
ORDER BY a.kode_transaksi ASC")
or die('Ada kesalahan pada query tampil Transaksi : '.mysqli_error($mysqli));
$count  = mysqli_num_rows($query);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Blue Ducks (lm)</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
</head>
<body>
    <div id="title">
        LAPORAN DATA BARANG MASUK
    </div>
    <?php
    if ($tgl_awal==$tgl_akhir) { ?>
    <div id="title-tanggal">
        Tanggal <?php echo tgl_eng_to_ind($tgl1); ?>
    </div>
    <?php
    } else { ?>
    <div id="title-tanggal">
        Tanggal <?php echo tgl_eng_to_ind($tgl1); ?> s.d. <?php echo tgl_eng_to_ind($tgl2); ?>
    </div>
    <?php
    }
    ?>
    
    <hr><br>
    <div id="isi">
        <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">KODE TRANSAKSI</th>
                    <th height="20" align="center" valign="middle">TANGGAL</th>
                    <th height="20" align="center" valign="middle">KODE BARANG</th>
                    <th height="20" align="center" valign="middle">NAMA BARANG</th>
                    <th height="20" align="center" valign="middle">JUMLAH MASUK</th>
                    <th height="20" align="center" valign="middle">HARGA BELI</th>
                    <th height="20" align="center" valign="middle">TOTAL HARGA BELI</th>
                    <th height="20" align="center" valign="middle">SATUAN</th>
                </tr>
                
            </thead>
            <tbody>
                <?php
                // jika data ada
                if($count == 0) {
                echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='155' height='13' valign='middle'></td>
                    <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'></td>
                    <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                </tr>";
                }
                // jika data tidak ada
                else {
                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {
                $tanggal       = $data['tanggal_masuk'];
                $exp           = explode('-',$tanggal);
                $tanggal_masuk = $exp[2]."-".$exp[1]."-".$exp[0];
                $harga_beli = format_rupiah($data['harga_beli']);
                $total_harga_beli = format_rupiah($data['total_harga_beli']);

                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'>$no</td>
                    <td width='120' height='13' align='center' valign='middle'>$data[kode_transaksi]</td>
                    <td width='80' height='13' align='center' valign='middle'>$tanggal_masuk</td>
                    <td width='80' height='13' align='center' valign='middle'>$data[kode_barang]</td>
                    <td style='padding-left:5px;' width='155' height='13' valign='middle'>$data[nama_barang]</td>
                    <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'>$data[jumlah_masuk]</td>
                    <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'>Rp. $harga_beli</td>
                    <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'>Rp. $total_harga_beli</td>
                    <td width='80' height='13' align='center' valign='middle'>$data[satuan]</td>
                </tr>";
                $no++;
                }
                }
                ?>
            </tbody>
           <!--  <thead >
                <tr>    <th ></th>
                <th ></th>
                <th ></th>
                <th ></th>
                <th ></th>
                <th style="background:#e8ecee" colspan="1" align='right' >TOTAL SEMUA</th>
                <th style="background:#e8ecee" colspan="2" align='right' >Rp. 123</th>
            </tr>
        </thead> -->
    </table>
    <div id="footer-tanggal">
        Jakarta, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
    </div>
    <div id="footer-jabatan">
        Pimpinan
    </div>
    
    <div id="footer-nama">
        Blue Ducks
    </div>
</div>
<!-- Script Untuk Print Laporan -->
<script>
        window.print();
</script>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->