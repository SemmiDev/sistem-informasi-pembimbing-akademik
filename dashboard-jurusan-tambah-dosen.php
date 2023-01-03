<?php

error_reporting(0);

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
    <title>Tambah Data Dosen</title>
</head>

<body class="bg-gray-50">
    <?php include 'navbar.php' ?>

    <div class="flex gap-5">
        <?php include 'sidebar-jurusan.php' ?>

        <div class="mx-auto mt-12">
            <form method="post" action="services/add-dosen-process.php" class="w-[400px] flex flex-col gap-3 mt-5 border border-1 p-5 shadow-xl shadow-orange-300/80 border-black rounded-xl">
                <h1 class="font-bold text-center text-slate-900">Tambah Data Dosen</h1>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Nama</span>
                    </label>
                    <input type="text" placeholder="Masukkan nama" name="nama" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="w-16 label">
                        <span class="text-sm text-black label-text">NIP</span>
                    </label>
                    <input type="text" minlength="18" maxlength="18" placeholder="Masukkan NIP" name="nip" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Password</span>
                    </label>
                    <input type="password" placeholder="***********" name="password" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>

                <button type="submit" name="add-dosen-button" class="w-full px-3 py-3 text-sm font-semibold text-white bg-orange-500 rounded-lg">
                    Tambah
                </button>
            </form>
        </div>
    </div>
</body>

</html>
