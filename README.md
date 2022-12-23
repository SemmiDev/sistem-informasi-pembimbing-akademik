## Schema Database

```
-- language: SQL (MySQL)

DROP DATABASE IF EXISTS bimakad;
CREATE DATABASE IF NOT EXISTS bimakad;
USE bimakad;

CREATE TABLE pengguna (
    id INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    nip VARCHAR(255) DEFAULT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nomor_handphone VARCHAR(255) DEFAULT NULL,
    peran VARCHAR(255) DEFAULT 'jurusan', -- jurusan, dosen
    PRIMARY KEY (id)
);

CREATE TABLE mahasiswa (
    id INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    nim VARCHAR(255) NOT NULL UNIQUE,
    program_studi VARCHAR(255) NOT NULL,
    angkatan VARCHAR(255) NOT NULL,
    nomor_handphone VARCHAR(255) NOT NULL,
    id_dosen_pa INT NOT NULL,
    semester INT NOT NULL,
    dibuat_pada DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    diupdate_pada DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (id_dosen_pa) REFERENCES pengguna(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE bimbingan (
    id INT NOT NULL AUTO_INCREMENT,
    id_mahasiswa INT NOT NULL,
    id_dosen INT NOT NULL,
    tanggal_bimbingan DATE NOT NULL,
    pertemuan_ke INT NOT NULL,
    judul VARCHAR(255) DEFAULT NULL,
    deskripsi TEXT DEFAULT NULL,
    hadir VARCHAR(200) NOT NULL,
    keterangan TEXT DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_mahasiswa) REFERENCES mahasiswa(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_dosen) REFERENCES pengguna(id) ON UPDATE CASCADE ON DELETE CASCADE
)
```
# sistem-informasi-pembimbing-akademik