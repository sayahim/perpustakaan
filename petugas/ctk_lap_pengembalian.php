<?php
session_start();
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

  $tgl1=$_GET['tgl1'];
  $tgl2=$_GET['tgl2'];
?>
<html>
<head>
<title>Laporan Data Peminjaman</title>
<script src="../assets/jquery/dist/jquery.min.js"></script>
<style type="text/css">
.detail {
  background:#FFFDD0; color:#333; display:inline-block;
  padding:5px;
}
.daftar-keranjang {
  margin:10px 0;
}
.daftar-keranjang table a:hover { color:#E10000; }
.daftar-keranjang {
  margin:10px 0;
}
.daftar-keranjang .no { text-align:center;  }
.daftar-keranjang table tr { border-collapse:collapse; }
.daftar-keranjang table tr td {
  padding:10px 10px;
  /*border-bottom:1px solid #06F;*/
}
.daftar-keranjang table .bor {
  padding:10px 10px;
  border-top:1px solid #06F;
}
.daftar-keranjang table tr:hover td {
  background:#FFF; color:#333;
}
.daftar-keranjang table tr th {
  padding:10px 10px;
  text-align:center;
  color:#333;
  font-weight:normal;
  font-size:16px;
  font-weight: bold;
  border-bottom:1px dashed #06F;
  background:url(../images/pattern-head.png);
}
tr.item td {
  text-align:center;
}
tr.total td { border-bottom:none!important;}
</style>
</head>
<body>
<center>
  <div style="width:980px;">
    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="../upload/SMP 4 Samigaluh.png"  width="70" /></td>
        <td style="font-weight:bold;text-align:center;">
          <div style="font-size:20px;">SISTEM INFORMASI PERPUSTAKAAN <br> SMPN 4 SAMIGALUH</div>
          <div style="font-size:16px;font-family:Times New Roman,Times,serif">LAPORAN DATA PENGEMBALIAN</div>
          <div style="font-size:16px;"></div>
        </td>
      </tr>
    </table>
<div class="entry">
 <br>
  <table width="500px" border="0" cellpadding="3px" align="left">
    <tr>
    </tr>

  </table>

</div>

<div class="daftar-keranjang">
  <table width="100%" cellpadding="3px" border="1" cellspacing="0">
    <thead>
      <tr >
        <th>No</th>
        <th>Kode Kembali</th>
        <th>Tanggal Kembali</th>
        <th>Petugas</th>
        <th>Kode Pinjam</th>
        <th>Tanggal Pinjam</th>
        <th>Anggota</th>
        <th>Denda</th>
      </tr>
    </thead>
    <tbody>
                <?php
                    $no=1;
                    $query="SELECT kd_pengembalian, tgl_kembali, PM.kd_petugas, nama_petugas, PM.kd_peminjaman, tgl_peminjaman, PJ.kd_anggota, nama_anggota, total_denda FROM pengembalian PM JOIN peminjaman PJ ON PM.kd_peminjaman=PJ.kd_peminjaman JOIN petugas PT ON PM.kd_petugas=PT.kd_petugas JOIN anggota A ON PJ.kd_anggota=A.kd_anggota where tgl_kembali between '$tgl1' and '$tgl2'";
                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                        while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $kd_pengembalian; ?></td>
                      <td><?php echo date('d-M-Y', strtotime($tgl_kembali)); ?></td>
                      <td><?php echo $nama_petugas; ?></td>
                      <td><?php echo $kd_peminjaman; ?></td>
                      <td><?php echo date('d-M-Y', strtotime($tgl_peminjaman)); ?></td>
                      <td><?php echo $nama_anggota; ?></td>
                      <td><?php echo $total_denda; ?></td>
                    </tr>
                <?php }} ?>

    
    </tbody>
  </table>
</div>
    <p align="center"><a href="" class="no" onClick="window.print()" title="Cetak">[Cetak]</a></p>
  </div>
</center>
<script>$(function(){
    print()
  })
</script>
</body>
</html>
