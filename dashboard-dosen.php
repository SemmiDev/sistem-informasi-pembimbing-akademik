<?php

error_reporting(0);

session_start();

$userLogin = $_SESSION['user'];
if ($userLogin['peran'] != 'dosen') {
    header('Location: logout.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'head.php'; ?>
</head>

<body class="bg-gray-50">
    <?php include 'navbar.php' ?>

    <div class="flex gap-5">
        <?php include 'sidebar-dosen.php' ?>

        <div class="m-20 w-[500px] lg:w-[650px]">
            <div class="flex flex-col gap-2 overflow-hidden bg-white rounded-xl">
                <div class="w-full p-3 text-white bg-orange-500">
                    Selamat Datang
                </div>
                <p class="p-3 font-semibold text-black text-md">Portal bimbingan akademik adalah aplikasi yang memungkinkan mahasiswa dapat berkomunikasi dengan pembimbing akademik dalam menyelesaikan berbagai keluhan yang dialami secara intens.</p>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
