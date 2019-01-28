<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{

	$stmt = $mysqli->prepare("INSERT INTO pengarang 
		(kd_pengarang,nama_pengarang) 
		VALUES (?, ?)");

	$stmt->bind_param("ss",
		mysqli_real_escape_string($mysqli, $_POST['kode']), 
		mysqli_real_escape_string($mysqli, $_POST['nama']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data pengarang Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=pengarang';</script>";	
	} else {
		echo "<script>alert('Data pengarang Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){


	$stmt = $mysqli->prepare("UPDATE pengarang  SET 
		nama_pengarang=?
		where kd_pengarang=?");
	$stmt->bind_param("ss",
		mysqli_real_escape_string($mysqli, $_POST['nama']),	 
		mysqli_real_escape_string($mysqli, $_POST['kode']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data pengarang Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=pengarang';</script>";	
	} else {
		echo "<script>alert('Data pengarang Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	$stmt = $mysqli->prepare("DELETE FROM pengarang where kd_pengarang=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data pengarang Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=pengarang';</script>";	
	} else {
		echo "<script>alert('Data pengarang Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>