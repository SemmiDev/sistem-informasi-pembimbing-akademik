<?php

require_once("../config.php");

if (isset($_POST['add-mahasiswa-button'])) {
    $dosenId = $_POST['idDosen'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $programStudi = $_POST['programStudi'];
    $angkatan = $_POST['angkatan'];
    $noHp = $_POST['noHp'];
    $semester = $_POST['semester'];

    // menyiapkan query
    $sql = "INSERT INTO mahasiswa (nama, nim, program_studi, angkatan, nomor_handphone, id_dosen_pa, semester)
            VALUES (:name, :nim, :programStudi, :angkatan, :noHp, :dosenId, :semester)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
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
