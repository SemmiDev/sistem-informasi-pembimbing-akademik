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

    <?php

    include 'config.php';

    $sql = "SELECT * FROM pengguna WHERE peran='dosen'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $listDosen = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <div class="flex gap-5">
        <?php include 'sidebar-jurusan.php' ?>

        <div class="mx-auto mt-12">
            <form method="post" action="services/add-mahasiswa-process.php" class="w-[400px] flex flex-col gap-3 mt-5 border border-1 p-5 shadow-xl shadow-orange-300/80 border-black rounded-xl">
                <h1 class="font-bold text-center text-slate-900">Tambah Data Mahasiswa</h1>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Nama</span>
                    </label>
                    <input type="text" placeholder="Masukkan nama" name="nama" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="w-16 label">
                        <span class="text-sm text-black label-text">NIM</span>
                    </label>
                    <input type="text" placeholder="Masukkan NIM" name="nim" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Program Studi</span>
                    </label>
                    <input type="text" placeholder="Masukkan Program Studi" name="programStudi" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Angkatan</span>
                    </label>
                    <input type="number" placeholder="Masukkan  Angkatan" name="angkatan" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">No. Handphone</span>
                    </label>
                    <input type="text" placeholder="Masukkan No Handphone" name="noHp" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Nama Dosen</span>
                    </label>
                    <select name="idDosen" class="w-full text-xs bg-white border select text-slate-900 select-sm border-black/50 input-bordered ">
                        <!--  loop $listDosen -->
                        <?php foreach ($listDosen as $dosen) : ?>
                            <option value="<?= $dosen['id'] ?>"><?= $dosen['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Semester</span>
                    </label>
                    <input type="number" placeholder="Masukkan semester" name="semester" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <button type="submit" name="add-mahasiswa-button" class="w-full px-3 py-3 text-sm font-semibold text-white bg-orange-500 rounded-lg">
                    Tambah
                </button>
            </form>
        </div>
    </div>
</body>

</html>
