CREATE DATABASE IF NOT EXISTS inventaris_lab;
USE inventaris_lab;

CREATE TABLE jenis_perangkat (
    id_jenis INT AUTO_INCREMENT PRIMARY KEY,
    nama_jenis VARCHAR(100) NOT NULL
);

CREATE TABLE perangkat (
    id_perangkat INT AUTO_INCREMENT PRIMARY KEY,
    id_jenis INT NOT NULL,
    nama_barang VARCHAR(150) NOT NULL,
    kondisi VARCHAR(50) NOT NULL,
    foto_kondisi VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_jenis) REFERENCES jenis_perangkat(id_jenis) ON DELETE CASCADE
);

INSERT INTO jenis_perangkat (nama_jenis) VALUES ('PC'), ('Laptop'), ('Proyektor'), ('Router');
