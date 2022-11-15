<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

if(isset($_POST['dataidobat'])) {
	$kode_helm = $_POST['dataidobat'];

  // fungsi query untuk menampilkan data dari tabel helm
  $query = mysqli_query($mysqli, "SELECT kode_barang,nama_barang,satuan,stok,harga_beli FROM is_barang WHERE kode_barang='$kode_helm'")
                                  or die('Ada kesalahan pada query tampil data helm: '.mysqli_error($mysqli));

  // tampilkan data
  $data = mysqli_fetch_assoc($query);

  $stok   = $data['stok'];
  $satuan = $data['satuan'];
  $harga_beli = $data['harga_beli'];

	if($stok != '') {
		echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='$stok' readonly>
                    <span class='input-group-addon'>$satuan</span>
                  </div>
                </div>
              </div>";
	} 
  else {
		echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='Stok barang tidak ditemukan' readonly>
                    <span class='input-group-addon'>Satuan stok tidak ditemukan</span>
                  </div>
                </div>
              </div>";
	}

  if($harga_beli != '') {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Harga Beli</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                  <span class='input-group-addon'>Rp.</span>
                    <input type='text' class='form-control' id='harga_beli' name='harga_beli' value='$harga_beli' readonly>
                    
                  </div>
                </div>
              </div>";
  } 

   else {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Harga Beli</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='harga_beli' name='harga_beli' value='Harga beli barang tidak ditemukan' readonly>
                    <span class='input-group-addon'>Satuan stok tidak ditemukan</span>
                  </div>
                </div>
              </div>";
  }

		
}
?> 