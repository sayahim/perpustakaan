<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{

	$stmt = $mysqli->prepare("INSERT INTO denda 
		(kd_denda,biaya) 
		VALUES (?, ?)");

	$stmt->bind_param("ss",
		mysqli_real_escape_string($mysqli, $_POST['kode']), 
		mysqli_real_escape_string($mysqli, $_POST['nama']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data denda Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=denda';</script>";	
	} else {
		echo "<script>alert('Data denda Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){


	$stmt = $mysqli->prepare("UPDATE denda  SET 
		biaya=?
		where kd_denda=?");
	$stmt->bind_param("ss",
		mysqli_real_escape_string($mysqli, $_POST['nama']),	 
		mysqli_real_escape_string($mysqli, $_POST['kode']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data denda Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=denda';</script>";	
	} else {
		echo "<script>alert('Data denda Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	$stmt = $mysqli->prepare("DELETE FROM denda where kd_denda=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data denda Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=denda';</script>";	
	} else {
		echo "<script>alert('Data denda Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>