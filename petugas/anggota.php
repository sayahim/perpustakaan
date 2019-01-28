

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Olah Data Anggota</h3>
              <div class="box-tools pull-right">
                 <a href="?hal=anggota_olah" class="btn btn-primary btn-flat" style="float:right;margin-top:0px;"><i class="fa  fa-plus-square"></i> Tambah Data</a>
              </div> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!-- <th>No</th> -->
                  <th>Kode</th>
                  <th>Nama anggota</th>
                  <th>Alamat</th>
                  <th>Jenis Kelamin</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    $query="SELECT * from anggota";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                    ?>
                    <tr>
                      <!-- <td><?php echo $no++ ?></td> -->
                      <td><?php echo $kd_anggota; ?></td>
                      <td><?php echo $nama_anggota; ?></td>
                      <td><?php echo $alamat; ?></td>
                      <td><?php echo $jenis_kelamin; ?></td>
                      <td>
                        <a href="?hal=anggota_olah&id=<?php echo $kd_anggota; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                        <a href="anggota_proses.php?hapus=<?php echo $kd_anggota;?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus [[ <?php echo $nama_anggota;?> ]] ??')"><i class="fa fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                <?php }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
