<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"anggota","kd_anggota='$kode'"));
    $a = "Edit Data";

}else{
    $kd_anggota=KodeOtomatis($mysqli,"anggota","kd_anggota","AG","2","8");
    $nama_anggota="";
    $alamat="";
    $jenis_kelamin="laki-laki";
    $a = "Tambah Data";
}
?>
	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="anggota_proses.php" method="post" enctype="multipart/form-data">

		  <div class="form-group">
	        <label class="col-sm-3 control-label">Kode Anggota</label>
	        <div class="col-sm-4">
	          <input type="text" name="kode" class="form-control" required value="<?php echo $kd_anggota; ?>" readonly>
	        </div>
	        <!-- <div class="col-sm-4"></div> -->
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Nama Anggota</label>
	        <div class="col-sm-4">
	          <input type="text" name="nama" class="form-control" required value="<?php echo $nama_anggota; ?>" placeholder="Nama ...">
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Jenis Kelamin</label>
	        <div class="col-sm-4">
	          <!-- <input type="text" name="alamat" class="form-control" required value="<?php echo $alamat; ?>"> -->
	         	<div class="col-sm-6">
	          <input type="radio" name="jk" id="jk" value="laki-laki" <?php echo ($jenis_kelamin=='laki-laki')? 'checked' : ''; ?>> Laki-Laki
	          	</div>
	          	<div class="col-sm-6">
	          <input type="radio" name="jk" id="jk" value="perempuan" <?php echo ($jenis_kelamin=='perempuan')? 'checked' : ''; ?>> Perempuan
	          </div>
	        </div>
	      </div>

 		<div class="form-group">
	        <label class="col-sm-3 control-label">Alamat</label>
	        <div class="col-sm-4">
	          <textarea class="form-control" name="alamat" rows="4" placeholder="Alamat ..."><?php echo $alamat; ?></textarea>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label"> </label>
	        <div class="col-sm-4">
		        <div class="pull-left">
		        	<a href="?hal=anggota" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
		        </div>
		        <div class="text-right">
		           <input type="submit" name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="Simpan" class="btn btn-primary" > 
		        </div>
	        </div>
	      </div>

<!-- 	      <div class="pull-left">
	        <a href="?hal=petugas" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>  
	      </div>
	      <div class="text-right">
	        <input type="submit" name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="simpan" class="btn btn-primary" >  
	      </div> -->

	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->

		