<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"det_pengarang","kd_det_pengarang='$kode'"));
    $a = "Edit Data";

}else{
    $kd_det_pengarang=KodeOtomatis($mysqli,"det_pengarang","kd_det_pengarang","DP","2","8");
    $kd_buku="";
    $kd_pengarang="";
    $a = "Tambah Data";
}
?>
	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="pengarang_buku_proses.php" method="post" enctype="multipart/form-data">

		  <div class="form-group">
	        <label class="col-sm-3 control-label">Kode Det Pengarang</label>
	        <div class="col-sm-4">
	          <input type="text" name="kode" class="form-control" required value="<?php echo $kd_det_pengarang; ?>" readonly>
	        </div>
	      </div>

	      <div class="form-group">
	       	<label class="col-sm-3 control-label">Buku</label>
	        <div class="col-sm-4">
	        	<select class="form-control select2" name="buku">
	            <?php
	                $query="SELECT * from buku";
	                $result=$mysqli->query($query);
	                while ($data=mysqli_fetch_assoc($result)) {
	                ?>
	                	<option value="<?php echo $data['kd_buku'] ?>" <?php echo  pilihselect($kd_buku,$data['kd_buku']) ?>><?php echo $data['judul_buku'] ?></option>
	                <?php        
	                }
	            ?>
	            </select>
	        </div>
	      </div>

	      <div class="form-group">
	       	<label class="col-sm-3 control-label">Pengarang</label>
	        <div class="col-sm-4">
	        	<select class="form-control select2" name="pengarang">
	            <?php
	                $query="SELECT * from pengarang";
	                $result=$mysqli->query($query);
	                while ($data=mysqli_fetch_assoc($result)) {
	                ?>
	                	<option value="<?php echo $data['kd_pengarang'] ?>" <?php echo  pilihselect($kd_pengarang,$data['kd_pengarang']) ?>><?php echo $data['nama_pengarang'] ?></option>
	                <?php        
	                }
	            ?>
	            </select>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label"> </label>
	        <div class="col-sm-4">
		        <div class="pull-left">
		        	<a href="?hal=pengarang_buku" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
		        </div>
		        <div class="text-right">
		           <input type="submit" name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="Simpan" class="btn btn-primary" > 
		        </div>
	        </div>
	      </div>

	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->

		