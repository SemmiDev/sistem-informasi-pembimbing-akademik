<?php

require_once("../config.php");

if (isset($_POST['tambahkan-bimbingan'])) {
    $dosenId = $_POST['id_dosen'];
    $tanggalBimbingan = $_POST['tanggal_bimbingan'];
    $mahasiswaId = $_POST['id_mahasiswa'];
    $pertemuanKe = $_POST['pertemuan_ke'];
    $kehadiran = $_POST['kehadiran'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $keterangan = $_POST['keterangan'];

    // format 12/13/2022 = yy-mm-dd (compatible with DATE in MySQL)
    $tanggalBimbingan = date("Y-m-d", strtotime($tanggalBimbingan));

    $sql = "INSERT INTO bimbingan (id_dosen, id_mahasiswa, tanggal_bimbingan, pertemuan_ke, hadir, judul, deskripsi, keterangan)
            VALUES (:dosenId, :mahasiswaId, :tanggalBimbingan, :pertemuanKe, :kehadiran, :judul, :deskripsi, :keterangan)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":dosenId" => $dosenId,
        ":mahasiswaId" => $mahasiswaId,
        ":tanggalBimbingan" => $tanggalBimbingan,
        ":pertemuanKe" => $pertemuanKe,
        ":kehadiran" => $kehadiran,
        ":judul" => $judul,
        ":deskripsi" => $deskripsi,
        ":keterangan" => $keterangan
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if ($saved) header("Location: ../dashboard-dosen-bimbingan.php");
    header("Location: ../dashboard-dosen-bimbingan.php");
}
