CREATE DATABASE IF NOT EXISTS campusgear;
USE campusgear;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (nama, username, password)
VALUES ('Administrator', 'admin', MD5('admin123'));

CREATE TABLE alat (
    id_alat INT AUTO_INCREMENT PRIMARY KEY,
    nama_alat VARCHAR(100) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    jumlah INT NOT NULL DEFAULT 0,
    kondisi ENUM('Baik','Rusak Ringan','Rusak Berat') DEFAULT 'Baik',
    status ENUM('Tersedia','Dipinjam') DEFAULT 'Tersedia',
    foto VARCHAR(255) DEFAULT ''
);

CREATE TABLE peminjam (
    id_peminjam INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    prodi VARCHAR(100),
    no_hp VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_alat INT NOT NULL,
    id_peminjam INT NOT NULL,
    jumlah INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE NOT NULL,
    status ENUM('Dipinjam','Dikembalikan','Terlambat') DEFAULT 'Dipinjam',
    CONSTRAINT fk_transaksi_alat
        FOREIGN KEY (id_alat)
        REFERENCES alat(id_alat)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_transaksi_peminjam
        FOREIGN KEY (id_peminjam)
        REFERENCES peminjam(id_peminjam)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);