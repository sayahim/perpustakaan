<?php
if (isset($_GET['id'])){
    $kode=$_GET['id'];
    extract(ArrayData($mysqli,"buku","kd_buku='$kode'"));
    $a = "Edit Data";

}else{
    $kd_buku=KodeOtomatis($mysqli,"buku","kd_buku","KB","2","9");
    $judul_buku="";
    $kd_kategori="";
    $kd_penerbit="";
    $isbn="";
    $jumlah="";
    $tahun_terbit=date('Y');
    $a = "Tambah Data";
}
?>
	<div class="box">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b><?php echo $a; ?></b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="buku_proses.php" method="post" enctype="multipart/form-data">

		  <div class="form-group">
	        <label class="col-sm-3 control-label">Kode Buku</label>
	        <div class="col-sm-4">
	          <input type="text" name="kode" class="form-control" required value="<?php echo $kd_buku; ?>" readonly>
	        </div>
	        <!-- <div class="col-sm-4"></div> -->
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Judul Buku</label>
	        <div class="col-sm-4">
	          <input type="text" name="nama" class="form-control" required value="<?php echo $judul_buku; ?>" >
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Kategori</label>
	        <div class="col-sm-4">
	          <select class="form-control select2" name="kategori">
	            <?php
	                $query="SELECT * from kategori";
	                $result=$mysqli->query($query);
	                while ($data=mysqli_fetch_assoc($result)) {
	                ?>
	                	<option value="<?php echo $data['kd_kategori'] ?>" <?php echo  pilihselect($kd_kategori,$data['kd_kategori']) ?>><?php echo $data['nama_kategori'] ?></option>
	                <?php        
	                }
	            ?>
	          </select>
	        </div>
	      </div>

	      <div class="form-group">
	       	<label class="col-sm-3 control-label">Penerbit</label>
	        <div class="col-sm-4">
	        	<select class="form-control select2" name="penerbit">
	            <?php
	                $query="SELECT * from penerbit";
	                $result=$mysqli->query($query);
	                while ($data=mysqli_fetch_assoc($result)) {
	                ?>
	                	<option value="<?php echo $data['kd_penerbit'] ?>" <?php echo  pilihselect($kd_penerbit,$data['kd_penerbit']) ?>><?php echo $data['nama_penerbit'] ?></option>
	                <?php        
	                }
	            ?>
	            </select>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">ISBN</label>
	        <div class="col-sm-4">
	          <input type="number" name="isbn" maxlength="14" class="form-control" required value="<?php echo $isbn; ?>">
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Jumlah</label>
	        <div class="col-sm-4">
	          <input type="number" name="jumlah" min="0" maxlength="4" class="form-control" required value="<?php echo $jumlah; ?>" >
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label">Tahun Terbit</label>
	        <div class="col-sm-4">
	          <input type="number" name="thn_terbit" min="1000" maxlength="4" class="form-control" required value="<?php echo $tahun_terbit; ?>" >
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-3 control-label"> </label>
	        <div class="col-sm-4">
		        <div class="pull-left">
		        	<a href="?hal=buku" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a>
		        </div>
		        <div class="text-right">
		           <input type="submit" name="<?php echo  isset($_GET['id']) ? 'ubah' : 'tambah'; ?>" value="Simpan" class="btn btn-primary" > 
		        </div>
	        </div>
	      </div>

	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->

		