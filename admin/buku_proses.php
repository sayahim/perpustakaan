<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{

	$stmt = $mysqli->prepare("INSERT INTO buku 
		(kd_buku,judul_buku,kd_kategori,kd_penerbit,isbn,jumlah,tahun_terbit) 
		VALUES (?, ?, ?, ?, ?, ?, ?)");

	$stmt->bind_param("sssssss",
		mysqli_real_escape_string($mysqli, $_POST['kode']), 
		mysqli_real_escape_string($mysqli, $_POST['nama']),
		mysqli_real_escape_string($mysqli, $_POST['kategori']), 
		mysqli_real_escape_string($mysqli, $_POST['penerbit']), 
		mysqli_real_escape_string($mysqli, $_POST['isbn']), 
		mysqli_real_escape_string($mysqli, $_POST['jumlah']), 
		mysqli_real_escape_string($mysqli, $_POST['thn_terbit']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Buku Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=buku';</script>";	
	} else {
		echo "<script>alert('Data Buku Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){


	$stmt = $mysqli->prepare("UPDATE buku  SET 
		judul_buku=?,
		kd_kategori=?,
		kd_penerbit=?,
		isbn=?,
		jumlah=?,
		tahun_terbit=?
		where kd_buku=?");
	$stmt->bind_param("sssssss",
		mysqli_real_escape_string($mysqli, $_POST['nama']),
		mysqli_real_escape_string($mysqli, $_POST['kategori']), 
		mysqli_real_escape_string($mysqli, $_POST['penerbit']), 
		mysqli_real_escape_string($mysqli, $_POST['isbn']), 
		mysqli_real_escape_string($mysqli, $_POST['jumlah']),
		mysqli_real_escape_string($mysqli, $_POST['thn_terbit']),	 
		mysqli_real_escape_string($mysqli, $_POST['kode']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Buku Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=buku';</script>";	
	} else {
		echo "<script>alert('Data Buku Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	$stmt = $mysqli->prepare("DELETE FROM buku where kd_buku=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Buku Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=buku';</script>";	
	} else {
		echo "<script>alert('Data buku Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>