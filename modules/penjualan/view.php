<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  <i class="fa fa-sign-out icon-title"></i> Order
  <a class="btn btn-primary btn-social pull-right" href="?module=form_penjualan&form=add" title="Tambah Data" data-toggle="tooltip">
    <i class="fa fa-plus"></i> Tambah
  </a>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <?php
      // fungsi untuk menampilkan pesan
      // jika alert = "" (kosong)
      // tampilkan pesan "" (kosong)
      if (empty($_GET['alert'])) {
      echo "";
      }
      // jika alert = 1
      // tampilkan pesan Sukses "Data Helm Masuk berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
        Data Order berhasil disimpan.
      </div>";
      }
      ?>
      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel Helm -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Kode Pesanan</th>
                <th class="center">Nama Pelanggan</th>
                <th class="center">Tanggal</th>
                
                
                <th class="center">Jumlah</th>
                
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
              <?php
              $no = 1;
              // fungsi query untuk menampilkan data dari tabel helm
              $query = mysqli_query($mysqli,"select * from is_pesanan p, is_pelanggan pl where p.kode_pelanggan=pl.kode_pelanggan");
              while($p=mysqli_fetch_array($query)){
              $idorder        = $p['kode_order'];
              $namapelanggan  = $p['nama_pelanggan'];
              $tanggal        = $p['tanggal'];
              
              //hitung jumlah
              $hitungjumlah = mysqli_query($mysqli,"select * from is_detailpesanan where kode_pesanan='$idorder' ");
              $jumlah = mysqli_num_rows($hitungjumlah);
              
              // menampilkan isi tabel dari database ke tabel di aplikasi
              echo "<tr>
                <td width='30' class='center'>$no</td>
                <td width='100' class='center'>$p[kode_order]</td>
                <td width='80' class='center'>$p[nama_pelanggan]</td>
                <td width='80' class='center'>$p[tanggal];</td>
                
                <td width='200'>$jumlah</td>
                
              </tr>";
              $no++;
              }
              ?>
            </tbody>
          </table>
          </div><!-- /.box-body -->
          </div><!-- /.box -->
          </div><!--/.col -->
          </div>   <!-- /.row -->
        </section><!-- /.content