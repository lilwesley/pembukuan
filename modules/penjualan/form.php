<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?>
<!-- tampilan form add data -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  <i class="fa fa-edit icon-title"></i> Input Order
  </h1>
  <ol class="breadcrumb">
    <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
    <li><a href="?module=penjualanr"> Order </a></li>
    <li class="active"> Tambah </li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <!-- form start -->
        <form role="form" class="form-horizontal" action="modules/penjualan/proses.php?act=insert" method="POST" name="formOrder">
          <div class="box-body">
           
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Pelanggan</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="kode_pelanggan" data-placeholder="-- Pilih Pelanggan --" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                      $query_nama_pelanggan = mysqli_query($mysqli, "SELECT kode_pelanggan, nama_pelanggan FROM is_pelanggan ORDER BY nama_pelanggan ASC")
                                                            or die('Ada kesalahan pada query tampil obat: '.mysqli_error($mysqli));
                      while ($data_nama_pelanggan = mysqli_fetch_assoc($query_nama_pelanggan)) {
                        echo"<option value=\"$data_nama_pelanggan[kode_pelanggan]\"> $data_nama_pelanggan[kode_pelanggan] | $data_nama_pelanggan[nama_pelanggan] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div><!-- /.box body -->
            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=penjualan" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
              </div><!-- /.box footer -->
            </form>
            </div><!-- /.box -->
            </div><!--/.col -->
            </div>   <!-- /.row -->
            </section><!-- /.content -->
            <?php
            }
            ?>