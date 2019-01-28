<?php
session_start();
require_once 'setting/crud.php';
require_once 'setting/koneksi.php';
require_once 'setting/tanggal.php';

	$user=$_POST['username'];
	$pass=$_POST['password']; 

	$sqladmin="Select * from Petugas where level='Admin' and username='$user' and password='$pass'";
	$sqlpetugas="Select * from petugas where level='Petugas' and username='$user' and password='$pass'";
	$sqlkepala="Select * from petugas where level='Kepala' and username='$user' and password='$pass'";
	
	if (CekExist($mysqli,$sqladmin)== true){
		
		$_SESSION['adm']=caridata($mysqli,"Select kd_petugas from petugas where level='Admin' and username='$user' and password='$pass'");
		$_SESSION['namaptgs']=caridata($mysqli,"Select nama_petugas from petugas where level='Admin' and username='$user' and password='$pass'");
		echo "<script>alert('Anda login sebagai admin')</script>";
		echo "<script>window.location='admin/index.php?hal=beranda';</script>";

	}elseif (CekExist($mysqli,$sqlpetugas)== true){
		
		$_SESSION['ptgs']=caridata($mysqli,"Select kd_petugas from petugas where level='Petugas' and username='$user' and password='$pass'");
		$_SESSION['namaptgs']=caridata($mysqli,"Select nama_petugas from petugas where level='Petugas' and username='$user' and password='$pass'");
		echo "<script>alert('Anda login sebagai Petugas')</script>";
		echo "<script>window.location='petugas/index.php?hal=beranda';</script>";

	}elseif (CekExist($mysqli,$sqlkepala)== true){
		
		$_SESSION['kpl']=caridata($mysqli,"Select kd_petugas from petugas where level='Kepala' and username='$user' and password='$pass'");
		$_SESSION['namaptgs']=caridata($mysqli,"Select nama_petugas from petugas where level='Kepala' and username='$user' and password='$pass'");
		echo "<script>alert('Anda login sebagai Kepala')</script>";
		echo "<script>window.location='kepala/index.php?hal=beranda';</script>";

	}else{
		
		echo "<script>alert('Username atau password tidak terdaftar')</script>";
		echo "<script>window.location='login.php';</script>";
	
	}

?>