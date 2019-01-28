<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{

	$stmt = $mysqli->prepare("INSERT INTO det_pengarang 
		(kd_det_pengarang,kd_buku,kd_pengarang) 
		VALUES (?, ?, ?)");

	$stmt->bind_param("sss",
		mysqli_real_escape_string($mysqli, $_POST['kode']), 
		mysqli_real_escape_string($mysqli, $_POST['buku']), 
		mysqli_real_escape_string($mysqli, $_POST['pengarang']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data pengarang buku Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=pengarang_buku';</script>";	
	} else {
		echo "<script>alert('Data pengarang buku Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){


	$stmt = $mysqli->prepare("UPDATE det_pengarang SET 
		kd_buku=?,
		kd_pengarang=?
		where kd_det_pengarang=?");
	$stmt->bind_param("sss",
		mysqli_real_escape_string($mysqli, $_POST['buku']),	
		mysqli_real_escape_string($mysqli, $_POST['pengarang']), 
		mysqli_real_escape_string($mysqli, $_POST['kode']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data pengarang buku Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=pengarang_buku';</script>";	
	} else {
		echo "<script>alert('Data pengarang buku Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	$stmt = $mysqli->prepare("DELETE FROM det_pengarang where kd_det_pengarang=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data pengarang buku Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=pengarang_buku';</script>";	
	} else {
		echo "<script>alert('Data pengarang buku Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>