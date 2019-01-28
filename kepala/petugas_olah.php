<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"petugas","kd_petugas='$kode'"));
    $a = "Edit Data";

}else{
    $kd_petugas=KodeOtomatis($mysqli,"petugas","kd_petugas","P","1","2");
    $nama_petugas="";
    $username="";
    $password="";
    $level="";
    $a = "Tambah Data";
}
?>
	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="petugas_proses.php" method="post" enctype="multipart/form-data">

		  <div class="form-group">
	        <label class="col-sm-3 control-label">Kode Petugas</label>
	        <div class="col-sm-4">
	          <input type="text" name="kode" class="form-control" required value="<?php echo $kd_petugas; ?>" readonly>
	        </div>
	        <!-- <div class="col-sm-4"></div> -->
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Nama Petugas</label>
	        <div class="col-sm-4">
	          <input type="text" name="nama" class="form-control" required value="<?php echo $nama_petugas; ?>" >
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Username</label>
	        <div class="col-sm-4">
	          <input type="text" name="username" class="form-control" required value="<?php echo $username; ?>">
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Password</label>
	        <div class="col-sm-4">
	          <input type="text" name="password" class="form-control" required value="<?php echo $password; ?>">
	        </div>
	      </div>

	      <div class="form-group">
	       	<label class="col-sm-3 control-label">Level</label>
	        <div class="col-sm-4">
	          <select class="form-control" name="level">
	            <option value="Admin" <?php echo  pilihselect($level,"Admin") ?>>Admin</option>
	            <option value="Petugas" <?php echo  pilihselect($level,"Petugas") ?>>Petugas</option>
	            <option value="Kepala" <?php echo  pilihselect($level,"Kepala") ?>>Kepala</option>
	          </select>
	        </div>
	      </div>

	      <!-- <div class="form-group">
	        <label class="col-sm-3 control-label">Foto</label>
	        <div class="col-sm-4">
	          <input type="text" name="foto" class="form-control" required value="<?php echo $foto; ?>" >
	        </div>
	      </div> -->

	      <div class="form-group">
	        <label class="col-sm-3 control-label"> </label>
	        <div class="col-sm-4">
		        <div class="pull-left">
		        	<a href="?hal=petugas" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
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

		