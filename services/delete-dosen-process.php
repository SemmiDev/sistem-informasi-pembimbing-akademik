<?php

include '../config.php';

$dosenId = $_GET['id'];

$sql = "DELETE FROM pengguna WHERE id=:id";
$stmt = $db->prepare($sql);
$params = array(
    ":id" => $dosenId
);
$deleted = $stmt->execute($params);

header("Location: ../dashboard-jurusan-dosen.php");
