CREATE DATABASE db_perpus

--1. Tabel Petugas
CREATE TABLE petugas (
kd_petugas CHAR (3) NOT NULL PRIMARY KEY,
nama_petugas VARCHAR (30) NOT NULL,
username VARCHAR (30) NOT NULL,
PASSWORD VARCHAR(30) NOT NULL,
foto VARCHAR(30) NOT NULL,
LEVEL VARCHAR(20) NOT NULL
)ENGINE=INNODB;

--2. Tabel Anggota
CREATE TABLE anggota (
kd_anggota CHAR (10) NOT NULL PRIMARY KEY,
nama_anggota VARCHAR (30) NOT NULL,
alamat TEXT NOT NULL,
jenis_kelamin VARCHAR(20) NOT NULL
)ENGINE=INNODB;

--3. Tabel Penerbit
CREATE TABLE penerbit (
kd_penerbit CHAR (10) NOT NULL PRIMARY KEY,
nama_penerbit VARCHAR(20) NOT NULL
)ENGINE=INNODB;

--4. Tabel Kategori
CREATE TABLE kategori (
kd_kategori CHAR (10) NOT NULL PRIMARY KEY,
nama_kategori VARCHAR(20) NOT NULL
)ENGINE=INNODB;

--5. Tabel Pengaran
CREATE TABLE pengarang (
kd_pengarang CHAR (10) NOT NULL PRIMARY KEY,
nama_pengarang VARCHAR(30) NOT NULL
)ENGINE=INNODB;

--6. Tabel Buku
CREATE TABLE buku (
kd_buku CHAR (11) NOT NULL PRIMARY KEY,
judul_buku VARCHAR(50) NOT NULL,
kd_kategori CHAR (10) NOT NULL,
FOREIGN KEY fk_kd_kategori(kd_kategori)REFERENCES kategori(kd_kategori),
kd_penerbit CHAR (10) NOT NULL,
FOREIGN KEY fk_kd_penerbit(kd_penerbit)REFERENCES penerbit(kd_penerbit),
isbn CHAR (15) NOT NULL,
jumlah INT NOT NULL,
tahun_terbit YEAR NOT NULL
)ENGINE=INNODB;

--7. Tabel Det Pengarang
CREATE TABLE det_pengarang (
kd_det_pengarang CHAR (10) NOT NULL PRIMARY KEY,
kd_pengarang CHAR (10) NOT NULL,
FOREIGN KEY fk_kd_pengarang(kd_pengarang)REFERENCES pengarang(kd_pengarang),
kd_buku CHAR (11) NOT NULL,
FOREIGN KEY fk_kd_buku(kd_buku)REFERENCES buku(kd_buku)
)ENGINE=INNODB;

--8. Tabel Peminjaman
CREATE TABLE peminjaman (
kd_peminjaman CHAR (10) NOT NULL PRIMARY KEY,
tgl_peminjaman DATE NOT NULL,
kd_anggota CHAR (10) NOT NULL,
FOREIGN KEY fk_kd_anggota(kd_anggota)REFERENCES anggota(kd_anggota),
kd_petugas CHAR (3) NOT NULL,
FOREIGN KEY fk_kd_petugas(kd_petugas)REFERENCES petugas(kd_petugas),
STATUS VARCHAR (10) NOT NULL
)ENGINE=INNODB;

--9. Tabel Det Peminjaman
CREATE TABLE det_peminjaman (
kd_peminjaman CHAR (10) NOT NULL,
FOREIGN KEY fk_kd_peminjaman(kd_peminjaman)REFERENCES peminjaman(kd_peminjaman),
kd_buku CHAR (11) NOT NULL,
FOREIGN KEY fk_kd_buku(kd_buku)REFERENCES buku(kd_buku)
)ENGINE=INNODB;

--10. Tabel Denda
CREATE TABLE denda (
kd_denda INT NOT NULL PRIMARY KEY,
biaya INT NOT NULL
)ENGINE=INNODB;

--10. Tabel Pengembalian
CREATE TABLE pengembalian (
kd_pengembalian CHAR (10) NOT NULL PRIMARY KEY,
kd_peminjaman CHAR (10) NOT NULL,
FOREIGN KEY fk_kd_peminjaman(kd_peminjaman)REFERENCES peminjaman(kd_peminjaman),
tgl_kembali DATE NOT NULL,
kd_petugas CHAR (3) NOT NULL,
FOREIGN KEY fk_kd_petugas(kd_petugas)REFERENCES petugas(kd_petugas),
kd_denda INT NOT NULL,
FOREIGN KEY fk_kd_denda(kd_denda)REFERENCES denda(kd_denda),
total_denda INT NOT NULL
)ENGINE=INNODB;

SELECT kd_peminjaman, DP.kd_buku, judul_buku, B.kd_penerbit, nama_penerbit, tahun_terbit FROM det_peminjaman DP JOIN buku B ON DP.kd_buku=B.kd_buku JOIN Penerbit P ON B.kd_penerbit=P.kd_penerbit

SELECT * FROM denda ORDER BY kd_denda DESC LIMIT 1

SELECT * FROM det_peminjaman WHERE kd_peminjaman = 


UPDATE buku SET jumlah=(jumlah-1) WHERE kd_buku='KB000000001'


SELECT kd_peminjaman, tgl_peminjaman, P.kd_anggota, nama_angggota, kd_petugas, nama_petugas, STATUS 
FROM peminjaman P JOIN Anggota A ON P.kd_anggota=A.kd_anggota JOIN petugas PT ON P.kd_petugas=PT.kd_petugas


--3. Tabel Pelanggan
CREATE TABLE pelanggan (
id_pelanggan CHAR (11) NOT NULL PRIMARY KEY,
nama_pelanggan VARCHAR(50) NOT NULL,
no_Telp VARCHAR(15) NOT NULL
alamat TEXT NOT NULL
)ENGINE=INNODB;

--4. Tabel Suplier
CREATE TABLE suplier (
id_suplier CHAR (10) NOT NULL PRIMARY KEY,
nama_suplier VARCHAR(50) NOT NULL,
no_telp VARCHAR(15) NOT NULL,
alamat TEXT NOT NULL
)ENGINE=INNODB;

--5. Tabel Pembelian
CREATE TABLE pembelian (
kd_pembelian VARCHAR (50) NOT NULL PRIMARY KEY,
tanggal DATE NOT NULL,
id_pengguna CHAR (5) NOT NULL,
FOREIGN KEY fk_id_pengguna(id_pengguna)REFERENCES pengguna(id_pengguna),
id_suplier CHAR (10) NOT NULL,
FOREIGN KEY fk_id_suplier(id_suplier)REFERENCES suplier(id_suplier),
total NUMERIC(18.0) NOT NULL,
potongan NUMERIC(18.0) NOT NULL
)ENGINE=INNODB;

--6. Tabel Detail Pembelian
CREATE TABLE det_pembelian (
kd_pembelian VARCHAR (50) NOT NULL,
FOREIGN KEY fk_kd_pembelian(kd_pembelian)REFERENCES pembelian(kd_pembelian),
id_barang CHAR (10) NOT NULL,
FOREIGN KEY fk_id_barang(id_barang)REFERENCES barang(id_barang),
harga_beli NUMERIC(18.0) NOT NULL,
jumlah INT NOT NULL
)ENGINE=INNODB;

--7. Tabel Penjualan
CREATE TABLE penjualan (
kd_penjualan CHAR (11) NOT NULL PRIMARY KEY,
tanggal DATE NOT NULL,
id_pengguna CHAR (5) NOT NULL,
FOREIGN KEY fk_id_pengguna(id_pengguna)REFERENCES pengguna(id_pengguna),
id_pelanggan CHAR (11) NOT NULL,
FOREIGN KEY fk_id_pelanggan(id_pelanggan)REFERENCES pelanggan(id_pelanggan),
total INT(11) NOT NULL
)ENGINE=INNODB;

--8. Tabel Detail Penjualan
CREATE TABLE det_penjualan (
kd_det_jual INT(11)NOT NULL PRIMARY KEY,
kd_penjualan CHAR (11) NOT NULL,
FOREIGN KEY fk_kd_penjualan(kd_penjualan)REFERENCES penjualan(kd_penjualan),
id_barang CHAR (10) NOT NULL,
FOREIGN KEY fk_id_barang(id_barang)REFERENCES barang(id_barang),
harga INT NOT NULL,
jumlah INT NOT NULL
)ENGINE=INNODB;

--9. Tabel Pengambilan
CREATE TABLE pengambilan (
kd_pengambilan CHAR (11) NOT NULL PRIMARY KEY,
kd_penjualan CHAR (11) NOT NULL,
FOREIGN KEY fk_kd_penjualan(kd_penjualan)REFERENCES penjualan(kd_penjualan),
id_pengguna CHAR (5) NOT NULL,
FOREIGN KEY fk_id_pengguna(id_pengguna)REFERENCES pengguna(id_pengguna),
tanggal DATE NOT NULL
)ENGINE=INNODB;

--10. Tabel Detail Pengambilan
CREATE TABLE det_pengambilan (
kd_pengambilan CHAR (11) NOT NULL,
FOREIGN KEY fk_kd_pengambilan(kd_pengambilan)REFERENCES pengambilan(kd_pengambilan),
id_barang CHAR (10) NOT NULL,
FOREIGN KEY fk_id_barang(id_barang)REFERENCES barang(id_barang),
jumlah INT NOT NULL
)ENGINE=INNODB;

