<?php
session_start();
$userLogin = $_SESSION['user'];
if ($userLogin['peran'] != 'jurusan') {
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

        <?php include 'sidebar-jurusan.php' ?>

        <?php
        include 'config.php';

        // count total dosen
        $sql = "SELECT COUNT(*) AS total_dosen FROM pengguna WHERE peran = 'dosen'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $totalDosen = $stmt->fetch(PDO::FETCH_ASSOC);

        // count total mahasiswa
        $sql = "SELECT COUNT(*) AS total_mahasiswa FROM mahasiswa";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $totalMahasiswa = $stmt->fetch(PDO::FETCH_ASSOC);

        ?>

        <div class="m-20">
            <div class="flex gap-5">

                <div class="flex gap-2 border border-2 rounded-lg">
                    <div class="flex flex-col items-center gap-2 font-semibold text-black">
                        <img src="./images/daftar-dosen.png" class="w-12 h-12">
                        <span class="px-3">Jumlah Dosen</span>
                    </div>
                    <div class="flex bg-[#F4CE9B] justify-center items-center">
                        <h1 class="p-5 text-2xl font-bold text-black"><?= $totalDosen['total_dosen'] ?></h1>
                    </div>
                </div>

                <div class="flex gap-2 border border-2 rounded-lg">
                    <div class="flex flex-col items-center gap-2 font-semibold text-black">
                        <img src="./images/daftar-mhs.png" class="w-12 h-12">
                        <span class="px-3">Jumlah Mahasiswa</span>
                    </div>
                    <div class="flex bg-[#F4CE9B] justify-center items-center">
                        <h1 class="p-5 text-2xl font-bold text-black"><?= $totalMahasiswa['total_mahasiswa'] ?></h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
