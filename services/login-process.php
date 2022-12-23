<?php

require_once("../config.php");

if (isset($_POST['login'])) {
    $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST["password"];

    $sql = "SELECT * FROM pengguna WHERE nip=:nip";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":nip" => $nip
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if ($user) {
        // verifikasi password
        if ($password == $user["password"]) {
            // buat Session
            session_start();

            $_SESSION["user"] = $user;

            if ($user['peran'] == 'jurusan') {
                header("Location: ../dashboard-jurusan.php");
            } else {
                header("Location: ../dashboard-dosen.php");
            }
        } else {
            // login gagal, alihkan ke halaman login kembali
            header("Location: ../login.php");
        }
    }
}
