<?php

require_once("../config.php");

class AddBimbinganReq
{
    public $db;
    public $dosenId;
    public $tanggalBimbingan;
    public $mahasiswaId;
    public $pertemuanKe;
    public $kehadiran;
    public $judul;
    public $deskripsi;
    public $keterangan;

    public function tambahBimbingan()
    {


        // format 12/13/2022 = yy-mm-dd (compatible with DATE in MySQL)
        $tanggalBimbingan = date("Y-m-d", strtotime($this->tanggalBimbingan));

        $sql = "INSERT INTO bimbingan (id_dosen, id_mahasiswa, tanggal_bimbingan, pertemuan_ke, hadir, judul, deskripsi, keterangan)
            VALUES (:dosenId, :mahasiswaId, :tanggalBimbingan, :pertemuanKe, :kehadiran, :judul, :deskripsi, :keterangan)";
        $stmt = $this->db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":dosenId" => $this->dosenId,
            ":mahasiswaId" => $this->mahasiswaId,
            ":tanggalBimbingan" => $tanggalBimbingan,
            ":pertemuanKe" => $this->pertemuanKe,
            ":kehadiran" => $this->kehadiran,
            ":judul" => $this->judul,
            ":deskripsi" => $this->deskripsi,
            ":keterangan" => $this->keterangan
        );

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);

        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if ($saved) header("Location: ../dashboard-dosen-bimbingan.php");
        header("Location: ../dashboard-dosen-bimbingan.php");
    }
}

if (isset($_POST['tambahkan-bimbingan'])) {
    $dosenId = $_POST['id_dosen'];
    $tanggalBimbingan = $_POST['tanggal_bimbingan'];
    $mahasiswaId = $_POST['id_mahasiswa'];
    $pertemuanKe = $_POST['pertemuan_ke'];
    $kehadiran = $_POST['kehadiran'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $keterangan = $_POST['keterangan'];

    $bimbingan = new AddBimbinganReq();
    $bimbingan->db = $db;
    $bimbingan->dosenId = $dosenId;
    $bimbingan->tanggalBimbingan = $tanggalBimbingan;
    $bimbingan->mahasiswaId = $mahasiswaId;
    $bimbingan->pertemuanKe = $pertemuanKe;
    $bimbingan->kehadiran = $kehadiran;
    $bimbingan->judul = $judul;
    $bimbingan->deskripsi = $deskripsi;
    $bimbingan->keterangan = $keterangan;
    $bimbingan->tambahBimbingan();
}
