<?php

require_once("../config.php");

if (isset($_POST['edit-dosen-button'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_SPECIAL_CHARS);
    $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    // update query
    $sql = "UPDATE pengguna SET nama=:name, nip=:nip, password=:password WHERE id=:id";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":id" => $id,
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
