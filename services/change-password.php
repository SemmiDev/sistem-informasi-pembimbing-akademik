<?php

require_once("../config.php");

if (isset($_POST['change-password-button'])) {
    $id = $_POST['id'];
    $old = $_POST['password-old'];
    $new = $_POST['password-new'];

    $image_file = $_FILES["image"];

    $image_name = $id . "-" . $image_file["name"];
    move_uploaded_file(
        $image_file["tmp_name"],
        "../uploads/" . $image_name,
    );

    $query = "SELECT * FROM pengguna WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user['password'] != $old) {
        header("Location: ../dashboard-jurusan-ubah-password.php");
        exit;
    }

    if ($image_file) {
        $sql = "UPDATE pengguna SET password=:password, foto_profile=:foto_profile WHERE id=:id";
        $stmt = $db->prepare($sql);
        $params = array(
            ":id" => $id,
            ":password" => $new,
            ":foto_profile" => $image_name,
        );
        $saved = $stmt->execute($params);

        header("Location: ../logout.php");
    } else {
        $sql = "UPDATE pengguna SET password=:password WHERE id=:id";
        $stmt = $db->prepare($sql);
        $params = array(
            ":id" => $id,
            ":password" => $new,
        );
        $saved = $stmt->execute($params);

        if ($user['peran'] == 'dosen') {
            header("Location: ../dashboard-dosen-ubah-password.php");
        } else {
            header("Location: ../dashboard-jurusan-ubah-password.php");
        }
    }
}
