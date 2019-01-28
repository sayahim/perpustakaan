<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{

	$stmt = $mysqli->prepare("INSERT INTO petugas 
		(kd_petugas,nama_petugas,username,password,foto,level) 
		VALUES (?, ?, ?, ?, ?, ?)");

	$stmt->bind_param("ssssss",
		mysqli_real_escape_string($mysqli, $_POST['kode']), 
		mysqli_real_escape_string($mysqli, $_POST['nama']),
		mysqli_real_escape_string($mysqli, $_POST['username']), 
		mysqli_real_escape_string($mysqli, $_POST['password']), 
		mysqli_real_escape_string($mysqli, $_POST['foto']), 
		mysqli_real_escape_string($mysqli, $_POST['level']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Petugas Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=petugas';</script>";	
	} else {
		echo "<script>alert('Data Petugas Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){


	$stmt = $mysqli->prepare("UPDATE petugas  SET 
		nama_petugas=?,
		username=?,
		password=?,
		foto=?,
		level=?
		where kd_petugas=?");
	$stmt->bind_param("ssssss",
		mysqli_real_escape_string($mysqli, $_POST['nama']),
		mysqli_real_escape_string($mysqli, $_POST['username']), 
		mysqli_real_escape_string($mysqli, $_POST['password']), 
		mysqli_real_escape_string($mysqli, $_POST['foto']), 
		mysqli_real_escape_string($mysqli, $_POST['level']),	 
		mysqli_real_escape_string($mysqli, $_POST['kode']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Petugas Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=petugas';</script>";	
	} else {
		echo "<script>alert('Data Petugas Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	$stmt = $mysqli->prepare("DELETE FROM petugas where kd_petugas=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data petugas Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=petugas';</script>";	
	} else {
		echo "<script>alert('Data petugas Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>