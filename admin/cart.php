<?php 
session_start();
require_once '../setting/koneksi.php';
if (isset($_GET['act'])) {
    $act    = $_GET['act'];

    switch ($act) {
        case 'add':
            if (isset($_GET['idbuku'])) {
                $idbrg  = $_GET['idbuku'];
                // $jns = $_GET['jenis'];
                $jml  = 1;


                $qbarang  = $mysqli->query("SELECT * FROM buku WHERE kd_buku='$idbrg'");
                $dbarang  = $qbarang->fetch_assoc();
                // $hrg = $dbarang['harga_eceran'];
                /* start cek dan update Stok */
                $stokawal = $dbarang['jumlah'];
                $nama_barang = $dbarang['judul_buku'];
                // $satuan = $dbarang['nama_satuan'];
                $upstok   = $stokawal - $jml;
                if ($stokawal <1) {
                  echo '<script>alert("Jumlah Habis")</script>';
                  echo "<script>window.location='javascript:history.go(-1)';</script>";
                }else{
                  if ($upstok <0) {
                    echo '<script>alert("Stok '.$nama_barang.' tidak cukup. Sisa Stok hanya '.$stokawal.'")</script>';
                    echo "<script>window.location='javascript:history.go(-1)';</script>";
                  }else{

                        if (isset($_SESSION['items'][$idbrg])) { 
                            unset($_SESSION['items'][$idbrg]);
                            $_SESSION['items'][$idbrg] = $jml; # ./jika produk sudah ada maka tambah 1
                        }else{
                            $_SESSION['items'][$idbrg] = $jml; # ./jika baru pertama kali klik beli //$_SESSION['items'][B001]=1;
                        }
                        // print_r($_SESSION);
                        header('location:./index.php?hal=peminjaman_olah');

                  }
                }
                /* end cek dan update Stok */ 




            }
            break;
        
        case 'plus':
            if (isset($_GET['idbrg'])) {
                $idbrg  = $_GET['idbrg'];
                if (isset($_SESSION['items'][$idbrg])) {
                    $_SESSION['items'][$idbrg] +=1 ; # ./ ditambah satu
                }
                header('location:./index.php?hal=penjualan_olah');
            }
            break;

        case 'min':
            if (isset($_GET['idbrg'])) {
                $idbrg = $_GET['idbrg'];
                if (isset($_SESSION['items'][$idbrg])) {
                    if ($_SESSION['items'][$idbrg] == 1) {
                        echo '<script>alert("Barang tidak boleh 0");window.location="./index.php?hal=penjualan_olah"</script>';
                    }else{
                        $_SESSION['items'][$idbrg] -=1; # ./ dikurangi satu satu
                        header('location:./index.php?hal=penjualan_olah');
                    }
                }       
            }   
            break;  

        case 'del':
            if (isset($_GET['idbrg'])) {
                $idbrg = $_GET['idbrg'];
                if (isset($_SESSION['items'][$idbrg])) {
                    unset($_SESSION['items'][$idbrg]);
                    // unset($_SESSION['items']['J'.$idbrg]);
                }
                header('location:./index.php?hal=peminjaman_olah');
            }
            break;

        case 'clear':
            if (isset($_SESSION['items'])) {
                unset($_SESSION['items']);
                header('location:./index.php?hal=peminjaman_olah');
            }
            break;      
    }

   # header('location:./penjualanbarang');
}
 ?>