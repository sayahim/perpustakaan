<?php
session_start();
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';
?>
<html>
<head>
<title>Laporan Data Buku</title>
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
          <div style="font-size:16px;font-family:Times New Roman,Times,serif">LAPORAN DATA BUKU</div>
          <div style="font-size:16px;"></div>
        </td>
        <!-- <td style="font-size:16px;text-align:right;" valign="top"><div style="font-weight: bold;">Thinker Shop </div>
          <div>Jl. Krapayakan <br/>
            Telp. (0274)????? - 206, Faks : (0274)6627838</div>
        </td> -->
      </tr>
    </table>
    
<div class="entry">
 <br>
  <table width="500px" border="0" cellpadding="3px" align="left">
    <tr>
<!--       <td colspan="2"><b>EVALUASI KEHADIRAN DOSEN <br> PROGRAM STUDI D3 MANAJEMEN INFORMATIKA <br> TAHUN AKADEMIK 2016/2017 SEMESTER GASAL</b>
      </td> -->
    </tr>

  </table>

</div>

<div class="daftar-keranjang">
  <table width="100%" cellpadding="3px" border="1" cellspacing="0">
    <thead>
      <tr >
        <th>No</th>
        <th>Kode</th>
        <th>Judul Buku</th>
        <th>Kategori</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>ISBN</th>
        <th>Jumlah</th>
        <th>Tahun Terbit</th>
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
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $kd_buku; ?></td>
                      <td><?php echo $judul_buku; ?></td>
                      <td><?php echo $nama_kategori; ?></td>
                      <td style="width: 180px">

                        <?php
                        $a="";
                        $query2="SELECT kd_buku, DP.kd_pengarang, nama_pengarang FROM det_pengarang DP JOIN pengarang P ON Dp.kd_pengarang=P.kd_pengarang where kd_buku ='$kd_buku'";
                        $result2=$mysqli->query($query2);
                        while ($data2=mysqli_fetch_assoc($result2)) {
                          $a = $a .', '. $data2['nama_pengarang'];?>

                        <?php
                        }
                          echo substr($a, 1);
                        ?>

                      </td>
                      <td><?php echo $nama_penerbit; ?></td>
                      <td><?php echo $isbn; ?></td>
                      <td><?php echo $jumlah; ?></td>
                      <td><?php echo $tahun_terbit; ?></td>
                    </tr>
                <?php }} ?>
    
    </tbody>
  </table>
</div>
    <p align="center"><a href="" onClick="window.print()" title="Cetak">[Cetak]</a></p>
  </div>
</center>
<script>$(function(){
    print()
  })
</script>
</body>
</html>
