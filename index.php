<?php
session_start();
$userLogin = $_SESSION['user'];
if (!$userLogin) {
    header('Location: login.php');
} else if ($userLogin['peran'] == 'jurusan') {
    header('Location: dashboard-jurusan.php');
} else if ($userLogin['peran'] == 'dosen') {
    header('Location: dashboard-dosen.php');
}
