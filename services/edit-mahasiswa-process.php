<?php

require_once("../config.php");

if (isset($_POST['edit-mahasiswa-button'])) {
    $id = $_POST['id'];
    $dosenId = $_POST['idDosen'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $programStudi = $_POST['programStudi'];
    $angkatan = $_POST['angkatan'];
    $noHp = $_POST['noHp'];
    $semester = $_POST['semester'];

    // menyiapkan query
    $sql = "UPDATE mahasiswa SET nama=:name, nim=:nim, program_studi=:programStudi, angkatan=:angkatan, nomor_handphone=:noHp, id_dosen_pa=:dosenId, semester=:semester WHERE id=:id";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":id" => $id,
        ":name" => $nama,
        ":nim" => $nim,
        ":programStudi" => $programStudi,
        ":angkatan" => $angkatan,
        ":noHp" => $noHp,
        ":dosenId" => $dosenId,
        ":semester" => $semester
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if ($saved) header("Location: ../dashboard-jurusan-mahasiswa.php");
}
