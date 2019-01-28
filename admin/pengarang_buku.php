          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Olah Data Pengarang Buku</h3>
              <div class="box-tools pull-right">
                 <!-- <button data-toggle="modal" data-target="#myModal" class="btn btn-primary" type="button"> <span class="label label-primary">( <i class="fa fa-plus"></i> ) ADD </span></button>  -->
                 <a href="?hal=pengarang_buku_olah" class="btn btn-primary btn-flat" style="float:right;margin-top:0px;"><i class="fa  fa-plus-square"></i> Tambah Data</a>
              </div> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!-- <th>No</th> -->
                  <th>NO</th>
                  <th>Judul Buku</th>
                  <th>Nama Pengarang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    $query="SELECT kd_det_pengarang, judul_buku, nama_pengarang from det_pengarang DP JOIN Buku B ON DP.kd_buku=B.kd_buku JOIN pengarang P ON DP.kd_pengarang=P.kd_pengarang";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $judul_buku; ?></td>
                      <td><?php echo $nama_pengarang; ?></td>
                      <td>
                        <a href="?hal=pengarang_buku_olah&id=<?php echo $kd_det_pengarang; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                        <a href="pengarang_buku_proses.php?hapus=<?php echo $kd_det_pengarang;?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ??')"><i class="fa fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                <?php }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
