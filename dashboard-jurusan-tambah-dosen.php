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
    <title>Tambah Data Dosen</title>
</head>

<body class="bg-gray-50">
    <?php include 'navbar.php' ?>

    <div class="flex gap-5">
        <?php include 'sidebar-jurusan.php' ?>

        <div class="mx-auto mt-12">
            <form method="post" action="services/add-dosen-process.php" class="w-[400px] flex flex-col gap-3 mt-5 border border-1 p-5 shadow-xl shadow-orange-300/80 border-black rounded-xl">
                <h1 class="text-slate-900 text-center font-bold">Tambah Data Dosen</h1>
                <div class="w-full">
                    <label class="label">
                        <span class="label-text text-sm text-black">Nama</span>
                    </label>
                    <input type="text" placeholder="Masukkan nama" name="nama" class="input input-sm  bg-white text-slate-900  border border-black/50 input-bordered w-full" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label w-16">
                        <span class="label-text text-sm text-black">NIP</span>
                    </label>
                    <input type="text" placeholder="Masukkan NIP" name="nip" class="input input-sm  bg-white text-slate-900  border border-black/50 input-bordered w-full" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="label-text text-sm text-black">Password</span>
                    </label>
                    <input type="password" placeholder="***********" name="password" class="input input-sm  bg-white text-slate-900  border border-black/50 input-bordered w-full" autofocus required />
                </div>

                <button type="submit" name="add-dosen-button" class="w-full text-white px-3 py-3 text-sm font-semibold bg-orange-500 rounded-lg">
                    Tambah
                </button>
            </form>
        </div>
    </div>
</body>

</html>
