

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data Peminjaman</h3>
              <div class="box-tools pull-right">
                 <!-- <button data-toggle="modal" data-target="#myModal" class="btn btn-primary" type="button"> <span class="label label-primary">( <i class="fa fa-plus"></i> ) ADD </span></button>  -->
                 <!-- <a href="?hal=peminjaman_olah" class="btn btn-primary btn-flat" style="float:right;margin-top:0px;"><i class="fa  fa-plus-square"></i> Tambah Data</a> -->
              </div> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!-- <th>No</th> -->
                  <th>Kode</th>
                  <th>Tanggal Pinjam</th>
                  <th>Anggota</th>
                  <!-- <th>Petugas</th> -->
                  <th>Tanggal Kembali</th>
                  <th>Denda</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    $query="SELECT kd_peminjaman, tgl_peminjaman, P.kd_anggota, nama_anggota, P.kd_petugas, nama_petugas, status, (SELECT tgl_kembali FROM pengembalian WHERE kd_peminjaman=P.kd_peminjaman) AS tgl_kembali, (SELECT total_denda FROM pengembalian WHERE kd_peminjaman=P.kd_peminjaman) AS denda FROM peminjaman P JOIN Anggota A ON P.kd_anggota=A.kd_anggota JOIN petugas PT ON P.kd_petugas=PT.kd_petugas WHERE status='Dikembalikan'";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                    ?>
                    <tr>
                      <!-- <td><?php echo $no++ ?></td> -->
                      <td><?php echo $kd_peminjaman; ?></td>
                      <td><?php echo date('d-m-Y', strtotime($tgl_peminjaman)); ?></td>
                      <td><?php echo $nama_anggota; ?></td>
                      <!-- <td><?php echo $nama_petugas; ?></td> -->
                      <td><?php echo date('d-m-Y', strtotime($tgl_kembali)); ?></td>
                      <td><?php echo $denda; ?></td>
                      <td>
                        <?php 
                        $tgl=date('Y-m-d');
                        $telat = cektelat($tgl_peminjaman,$tgl,7);
                        if($status=='Dipinjam'){
                          if($telat>0){
                            $status = 'Jatuh Tempo'; 
                          }
                        }
                        
                        echo $status; 
                        
                        ?>
                      </td>
                      <td>
                        <a href="?hal=pengembalian_lihat&id=<?php echo $kd_peminjaman; ?>" class="btn btn-info"><i class="fa fa-eye"></i> Lihat</a>
                        <!-- <a href="petugas_proses.php?hapus=<?php echo $kd_petugas;?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus [[ <?php echo $nama_petugas;?> ]] ??')"><i class="fa fa-trash"></i> Delete</a> -->
                      </td>
                    </tr>
                <?php }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
