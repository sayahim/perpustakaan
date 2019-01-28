<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"peminjaman","kd_peminjaman='$kode'"));
    $a = "Edit Data";
    // $tgl_kembali= date('Y-m-d', strtotime('+7 days', strtotime($tgl_peminjaman)));
    $tgl_kembali= cekkembali($tgl_peminjaman,'+7 days');
}
  //Cek jml hari telat
  if($status=='Dipinjam'){
    $tglskrg  = date('Y-m-d');
  }else{
    $tglskrg=SingleData($mysqli,"tgl_kembali","pengembalian WHERE kd_peminjaman='$kd_peminjaman'");
  }
  $telat = cektelat($tgl_peminjaman,$tglskrg,7);
  //ambil biaya denda
  $result=$mysqli->query("SELECT * FROM denda ORDER BY kd_denda DESC LIMIT 1");
  extract(mysqli_fetch_assoc($result));
  //Kalikan denda dengan hari
  $denda=($telat*$biaya);
  //cari jumlah buku yang dipinjam
  $jml=JumlahData($mysqli,"det_peminjaman WHERE kd_peminjaman = '$kd_peminjaman'");
  //kalikan jumlah buku dengan denda per hari
  $tot_denda=$denda*$jml;

?>
	<div class="box box-primary">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="peminjaman_proses.php" method="post" enctype="multipart/form-data">

	    <div class="col-sm-6">
		  <div class="form-group">
	        <label class="col-sm-4 control-label">Kode Peminjaman</label>
	        <div class="col-sm-7">
	          <input type="text" name="kode" class="form-control" form="pengembalian" required value="<?php echo $kd_peminjaman; ?>" readonly>
	        </div>
	        <!-- <div class="col-sm-4"></div> -->
	      </div>

	      <div class="form-group">
	       	<label class="col-sm-4 control-label">Anggota</label>
	        <div class="col-sm-7">
	        	<select class="form-control select2" name="idanggota" form="pengembalian" disabled>
	            <?php
	                $query="SELECT * from anggota";
	                $result=$mysqli->query($query);
	                while ($data=mysqli_fetch_assoc($result)) {
	                ?>
	                	<option value="<?php echo $data['kd_anggota'] ?>" <?php echo  pilihselect($kd_anggota,$data['kd_anggota']) ?>><?php echo $data['kd_anggota'] ?> || <?php echo $data['nama_anggota'] ?></option>
	                <?php        
	                }
	            ?>
	            </select>
	        </div>
	      </div>

        <div class="form-group">
          <label class="col-sm-4 control-label">Status</label>
          <div class="col-sm-7">
            <input type="text" name="tglkembali" class="form-control" value="<?php echo $status; ?>" readonly>
          </div>
        </div>

	    </div>
	    <div class="col-sm-6">

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Tanggal Pinjam</label>
	        <div class="col-sm-8">
	          <input type="text" name="tglpinjam" class="form-control" form="pengembalian" value="<?php echo date('d-m-Y', strtotime($tgl_peminjaman)); ?>" readonly>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Tanggal kembali</label>
	        <div class="col-sm-8">
	          <input type="text" name="tglkembali" class="form-control" value="<?php echo date('d-m-Y', strtotime($tgl_kembali)); ?>" readonly>
	        </div>
	      </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Telat</label>
          <div class="col-sm-3">
            <div class="input-group">
              <input type="text" name="denda" class="form-control" value="<?php echo $telat; ?>" readonly>
              <span class="input-group-addon">Hari</span>
            </div>
          </div>
          <label class="col-sm-1 control-label">Denda</label>
          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon">Rp.</span>
              <input type="text" name="denda" class="form-control" value="<?php echo number_format($tot_denda); ?>" readonly>
            </div>
          </div>
        </div>
	    </div>

	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->


	<!-- <div class="box box-primary"> -->
	<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Keranjang Buku</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th style="width: 10px">No</th>
              <th>Kode Buku</th>
              <th>Judul Buku</th>
              <th>Penerbit</th>
              <th>Tahun Terbit</th>
            </tr>

          <?php
              $total = 0;
              $no=1;

              $query="SELECT kd_peminjaman, DP.kd_buku, judul_buku, B.kd_penerbit, nama_penerbit, tahun_terbit FROM det_peminjaman DP JOIN buku B ON DP.kd_buku=B.kd_buku JOIN Penerbit P ON B.kd_penerbit=P.kd_penerbit where kd_peminjaman='$kd_peminjaman'";
              $result=$mysqli->query($query);
              while ($data=mysqli_fetch_assoc($result)) {
              $total = $no;
          ?>
         		<tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['kd_buku'] ?></td>
                <td><?php echo $data['judul_buku'] ?></td>
                <td><?php echo $data['nama_penerbit'] ?></td>
                <td><?php echo $data['tahun_terbit'] ?></td>
            </tr>
            <?php
              }
              ?>
          </table>

        </div>
        <!-- /.box-body -->
      <div class="box-footer">

        <div class="col-sm-5">
          <div class="form-group">
            <label class="col-sm-4 control-label"><h4><b>Jumlah Buku</b></h4></label>
            <div class="col-sm-2">
              <input type="text" name="total" class="form-control" value="<?php echo $total; ?>" readonly>
            </div>
          </div>
        </div>

        <div class="form-group">
            <form method="post" action="" id="pengembalian" align="right">
                <a href="?hal=pengembalian" class="btn btn-warning waves-effect m-l-5"><i class="fa fa-arrow-left"> Back</i></a>
            </form>
        </div>
	  </div>
      </div>
      <!-- /.box -->

