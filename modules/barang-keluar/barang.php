<?php
session_start();
// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
if(isset($_POST['dataidobat'])) {
  $kode_helm = $_POST['dataidobat'];
// fungsi query untuk menampilkan data dari tabel helm
$query = mysqli_query($mysqli, "SELECT kode_barang,nama_barang,satuan,stok,harga_jual FROM is_barang WHERE kode_barang='$kode_helm'")
or die('Ada kesalahan pada query tampil data helm: '.mysqli_error($mysqli));
// tampilkan data
$data = mysqli_fetch_assoc($query);
$stok   = $data['stok'];
$satuan = $data['satuan'];
$harga_jual = $data['harga_jual'];
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
  } else {
    echo "<div class='form-group'>
  <label class='col-sm-2 control-label'>Stok</label>
  <div class='col-sm-5'>
    <div class='input-group'>
      <input type='text' class='form-control' id='stok' name='stok' value='Stok Barang tidak ditemukan' readonly>
      <span class='input-group-addon'>Satuan stok tidak ditemukan</span>
    </div>
  </div>
</div>";
  }
if($harga_jual != '') {
echo "<div class='form-group'>
  <label class='col-sm-2 control-label'>Harga Jual</label>
  <div class='col-sm-5'>
    <div class='input-group'>
      <span class='input-group-addon'>Rp.</span>
      <input type='text' class='form-control' id='harga_jual' name='harga_jual' value='$harga_jual' readonly>
      
    </div>
  </div>
</div>";
}
else {
echo "<div class='form-group'>
  <label class='col-sm-2 control-label'>Harga Jual </label>
  <div class='col-sm-5'>
    <div class='input-group'>
      <input type='text' class='form-control' id='harga_jual' name='harga_jual' value='Harga jual barang tidak ditemukan' readonly>
      <span class='input-group-addon'>Satuan stok tidak ditemukan</span>
    </div>
  </div>
</div>";
}
}
?>