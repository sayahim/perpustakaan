

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Olah Data Buku</h3>
              <div class="box-tools pull-right">
                 <a href="?hal=buku_olah" class="btn btn-primary btn-flat" style="float:right;margin-top:0px;"><i class="fa  fa-plus-square"></i> Tambah Data</a>
              </div> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!-- <th>No</th> -->
                  <th>Kode</th>
                  <th>Judul Buku</th>
                  <th>Kategori</th>
                  <th>Penerbit</th>
                  <th>ISBN</th>
                  <th>Jumlah</th>
                  <th>Tahun Terbit</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    $query="SELECT kd_buku, judul_buku, nama_kategori, nama_penerbit, isbn, jumlah, tahun_terbit from buku B JOIN kategori K ON B.kd_kategori=K.kd_kategori JOIN penerbit P ON B.kd_penerbit=P.kd_penerbit";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                    ?>
                    <tr>
                      <!-- <td><?php echo $no++ ?></td> -->
                      <td><?php echo $kd_buku; ?></td>
                      <td><?php echo $judul_buku; ?></td>
                      <td><?php echo $nama_kategori; ?></td>
                      <td><?php echo $nama_penerbit; ?></td>
                      <td><?php echo $isbn; ?></td>
                      <td><?php echo $jumlah; ?></td>
                      <td><?php echo $tahun_terbit; ?></td>
                      <td>
                        <a href="?hal=buku_olah&id=<?php echo $kd_buku; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                        <a href="buku_proses.php?hapus=<?php echo $kd_buku;?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus [[ <?php echo $nama_buku;?> ]] ??')"><i class="fa fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                <?php }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
