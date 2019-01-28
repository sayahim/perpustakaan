<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{

	$stmt = $mysqli->prepare("INSERT INTO anggota 
		(kd_anggota,nama_anggota,jenis_kelamin,alamat) 
		VALUES (?, ?, ?, ?)");

	$stmt->bind_param("ssss",
		mysqli_real_escape_string($mysqli, $_POST['kode']), 
		mysqli_real_escape_string($mysqli, $_POST['nama']),
		mysqli_real_escape_string($mysqli, $_POST['jk']), 
		mysqli_real_escape_string($mysqli, $_POST['alamat']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Anggota Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=anggota';</script>";	
	} else {
		echo "<script>alert('Data Anggota Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){


	$stmt = $mysqli->prepare("UPDATE anggota  SET 
		nama_anggota=?,
		jenis_kelamin=?,
		alamat=?
		where kd_anggota=?");
	$stmt->bind_param("ssss",
		mysqli_real_escape_string($mysqli, $_POST['nama']),
		mysqli_real_escape_string($mysqli, $_POST['jk']), 
		mysqli_real_escape_string($mysqli, $_POST['alamat']),	 
		mysqli_real_escape_string($mysqli, $_POST['kode']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data Anggota Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=anggota';</script>";	
	} else {
		echo "<script>alert('Data Anggota Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	$stmt = $mysqli->prepare("DELETE FROM anggota where kd_anggota=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data anggota Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=anggota';</script>";	
	} else {
		echo "<script>alert('Data anggota Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>