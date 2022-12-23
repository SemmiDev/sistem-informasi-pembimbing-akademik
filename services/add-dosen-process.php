<?php

require_once("../config.php");

if (isset($_POST['add-dosen-button'])) {
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_SPECIAL_CHARS);
    $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    // menyiapkan query
    $sql = "INSERT INTO pengguna (nama, nip, password, peran)
            VALUES (:name, :nip, :password, 'dosen')";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":name" => $nama,
        ":nip" => $nip,
        ":password" => $password
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if ($saved) header("Location: ../dashboard-jurusan-dosen.php");
}
