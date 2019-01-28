<?php
	  $tgl=date('ym');
    $kd_peminjaman=KodeOtomatis($mysqli,"peminjaman","kd_peminjaman","PJ$tgl","6","4");
    $tgl_peminjaman= date('Y-m-d');
    $tgl_kembali= date('Y-m-d', strtotime('+7 days', strtotime($tgl_peminjaman)));
    $a = "Tambah Data";

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
	          <input type="text" name="kode" class="form-control" required value="<?php echo $kd_peminjaman; ?>" readonly>
	        </div>
	        <!-- <div class="col-sm-4"></div> -->
	      </div>

	      <div class="form-group">
	       	<label class="col-sm-4 control-label">Anggota</label>
	        <div class="col-sm-7">
	        	<select class="form-control select2" name="idanggota" form="peminjaman">
	            <?php
	                $query="SELECT * from anggota";
	                $result=$mysqli->query($query);
	                while ($data=mysqli_fetch_assoc($result)) {
	                ?>
	                	<option value="<?php echo $data['kd_anggota'] ?>"><?php echo $data['kd_anggota'] ?> || <?php echo $data['nama_anggota'] ?></option>
	                <?php        
	                }
	            ?>
	            </select>
	        </div>
	      </div>

	    </div>
	    <div class="col-sm-6">

	      <div class="form-group">
	        <label class="col-sm-4 control-label">Tanggal Pinjam</label>
	        <div class="col-sm-7">
	          <input type="date" name="tglpinjam" class="form-control" value="<?php echo $tgl_peminjaman; ?>" readonly>
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-4 control-label">Tanggal kembali</label>
	        <div class="col-sm-7">
	          <input type="date" name="tglkembali" class="form-control" value="<?php echo $tgl_kembali; ?>" readonly>
	        </div>
	      </div>
	    </div>

<!-- 	   	<div class="col-sm-12">
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Buku</label>
	        <div class="col-sm-7">
	          	<select class="form-control select2" name="buku">
	            <?php
	                $query="SELECT * from buku";
	                $result=$mysqli->query($query);
	                while ($data=mysqli_fetch_assoc($result)) {
	                ?>
	                	<option value="<?php echo $data['kd_buku'] ?>"><?php echo $data['kd_buku'] ?> | <?php echo $data['judul_buku'] ?></option>
	                <?php        
	                }
	            ?>
	            </select>
	        </div>
	        <div class="col-sm-2">
	        	<button class="btn btn-success btn-flat"><i class="fa fa-plus-square"></i> Tambah</button>
	    	</div>
	      </div>
	    </div>

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
 -->
	    </form>
	  </div><!-- /.box-body -->
	</div><!-- /.box -->


	<div class="box box-success">
	  <div class="box-header with-border">
	    <h3 class="box-title"><b>Pilih Buku</b></h3>
	  </div><!-- /.box-header -->
	  <div class="box-body">
	    <form class="form-horizontal" action="cart.php" method="get" enctype="multipart/form-data">

	   	<div class="col-sm-12">

	      <div class="form-group">
	        <label class="col-sm-2 control-label">Buku</label>
	        <div class="col-sm-3">
	        	<input type="hidden" value="add" name="act">
	          	<select class="form-control select2" name="idbuku" id="buku" onchange="cari();">
	          		<option class="hidden">--Pilih Buku--</option>
	            <?php
	                $query="SELECT * from buku";
	                $result=$mysqli->query($query);
	                while ($data=mysqli_fetch_assoc($result)) {
	                ?>
	                	<option value="<?php echo $data['kd_buku'] ?>"><?php echo $data['kd_buku'] ?> | <?php echo $data['judul_buku'] ?></option>
	                <?php        
	                }
	            ?>
	            </select>
	        </div>
	        <div class="col-sm-2">
	          <input type="text" name="penerbit" class="form-control" value="" placeholder="Penerbit" readonly>
	        </div>
	        <div class="col-sm-2">
	          <input type="text" name="tahun" class="form-control" value="" placeholder="Tahun" readonly>
	        </div>
	        <div class="col-sm-2">
	        	<button class="btn btn-success btn-flat"><i class="fa fa-plus-square"></i> Tambah</button>
	    	</div>
	      </div>

	    </div>

	    </form>
	  </div><!-- /.box-body -->

<!-- 	  <div class="box-footer">
	  	 <h3><b>Pilih Buku</b></h3>
	  </div> -->
	  
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
              <th style="width: 100px">Action</th>
            </tr>

                <?php
                // print_r($_SESSION);
                 
                if (isset($_SESSION['items'])){
                    $total = 0;
                    // print_r($_SESSION['items']);
                    $pb_qty = count($_SESSION['items']);
                    // echo $pb_qty;
                    
                    $no=1;
                    foreach ($_SESSION['items'] as $key=> $jml){
                        $query="SELECT * FROM buku B JOIN Penerbit P ON B.kd_penerbit=P.kd_penerbit WHERE kd_buku = '$key'";
                        $query2=$mysqli->query($query);
                        $rs = $query2->fetch_assoc();
                        
                        $total += $jml;

                  ?>

               		<tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $rs['kd_buku'] ?></td>
                        <td><?php echo $rs['judul_buku'] ?></td>
                        <td><?php echo $rs['nama_penerbit'] ?></td>
                        <td><?php echo $rs['tahun_terbit'] ?></td>
                        <td>
                            <a class="btn-sm btn-danger" title="Hapus Data" href="cart.php?act=del&idbrg=<?php echo $key; ?>"> <i class="fa fa-trash">  Hapus</i></a>
                        </td>
                    </tr>
                        
                <?php
                  }
                  ?>

                    <tr>
                        <td colspan="4"><b><p align="right">TOTAL BUKU</p></b></td>
                        <td><?php echo $total; ?>
                            <input type="hidden" value="<?php echo $total; ?>"" name="tot">
                        </td>
                        <td><a class="btn-sm btn-danger" href="cart.php?act=clear&ref=penjualanbarang"><i class="fa fa-refresh"></i> Clear</a></td>
                    </tr>

                  <?php
                }
                ?>

          </table>
        </div>
        <!-- /.box-body -->
      <div class="box-footer">
        <div class="form-group">
            <?php if ((!isset($_SESSION['items'])) || ($pb_qty=="0")){ ?>
                <h5 align="center" style="color: red">Detail Penjualan Masih Kosong !!</h5><br><br>
            <?php } ?>
            <form method="post" action="" id="peminjaman" align="center">
                <button type="submit" name="simpan" class="btn btn-primary" ><i class="fa fa-save"> Simpan</i></button>
                <!-- <input type="submit" class="btn btn-primary" name="simpan" value="Simpan" onclick="return validasi()"> -->
                <a href="?hal=peminjaman" class="btn btn-warning waves-effect m-l-5"><i class="fa fa-remove"> Batal</i></a>
            </form>
        </div>
	  </div>
      </div>
      <!-- /.box -->


<?php 
#error_reporting(0);
if (isset($_POST['simpan'])) {
  $idpinjam   =  $kd_peminjaman;
  $idpel = $_POST['idanggota'];
  $iduser = $_SESSION['admin'];

    if (isset($_SESSION['items'])) {
        $savepinjam = $mysqli->query("INSERT INTO peminjaman VALUES ('$idpinjam',now(),'$idpel','$iduser','Dipinjam')");
        // $savebayar = $mysqli->query("INSERT INTO piutang VALUES ('$idpiutang','$idpinjam','$dibayar',now())");
        if ($savepinjam){
            foreach ($_SESSION['items'] as $key=> $jml){
                    $idbuku    = $key;

                    $qbarang  = $mysqli->query("SELECT * FROM buku WHERE kd_buku='$idbuku'");
                    $dbarang  = $qbarang->fetch_assoc();
                    $totalbuku   += $jml;
                    $dp_qty       = $jml;

                    /* start cek dan update Stok */
                    $stokawal = $dbarang['jumlah'];
                    $upstok   = $stokawal - $dp_qty;
                    if ($stokawal <1) {
                      echo '<script>alert("Stok Habis")</script>';
                    }else{
                      if ($upstok <0) {
                        echo '<script>alert("Jumlah Buku tidak cukup. Sisa Buku hanya '.$stokawal.' ")</script>';
                      }else{
                        $sim_det = $mysqli->query("INSERT INTO det_peminjaman VALUES ('$idpinjam','$idbuku')");
                        if($sim_det){
                            $mysqli->query("UPDATE buku SET jumlah='$upstok' WHERE kd_buku='$idbuku'");                        
                        }
                      }
                    }
                    /* end cek dan update Stok */ 
            }
            
            $up_penjualan = $mysqli->query("UPDATE peminjaman SET status= 'Dipinjam' WHERE kd_peminjaman='$idpinjam'");
            if ($up_penjualan) {
              foreach ($_SESSION['items'] as $key => $value) {
                unset($_SESSION['items'][$key]);
              }
              unset($_SESSION['items']);
              echo '<script>alert("Peminjaman Berhasil Disimpan !!");window.location="./index.php?hal=peminjaman_olah"</script>';
            }
        }
    }
  
}
 ?>


<script>
    function cari(){
    	
        var bk = $('#buku').val();
        $.ajax({
            type    : 'POST',
            url     : 'ajax/cari.php',
            data    : {buku:bk},
            dataType :'json',
            success : function (hasil){                
                // console.log(hasil);
                $('[name=penerbit]').val(hasil.nama_penerbit);
                $('[name=tahun]').val(hasil.tahun_terbit);
            }
        })
    }
</script>
