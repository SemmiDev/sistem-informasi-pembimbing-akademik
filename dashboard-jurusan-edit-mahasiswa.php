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
    <title>Edit Data Mahasiswa</title>
</head>

<body class="bg-gray-50">
    <?php include 'navbar.php' ?>

    <?php

    include 'config.php';

    $id = $_GET['id'];
    $sql = "SELECT mahasiswa.* , pengguna.nama AS dosen_pa, pengguna.id AS id_dosen_pa FROM mahasiswa JOIN pengguna ON mahasiswa.id_dosen_pa = pengguna.id WHERE mahasiswa.id = $id LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $mhs = $stmt->fetch(PDO::FETCH_ASSOC);

    $listDosen = $db->query("SELECT * FROM pengguna WHERE peran = 'dosen'")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="flex gap-5">
        <?php include 'sidebar-jurusan.php' ?>

        <div class="mx-auto mt-12">
            <form method="post" action="services/edit-mahasiswa-process.php" class="w-[400px] flex flex-col gap-3 mt-5 border border-1 p-5 shadow-xl shadow-orange-300/80 border-black rounded-xl">
                <h1 class="text-slate-900 text-center font-bold">Edit Data Mahasiswa</h1>
                <!-- hidden -->
                <input type="hidden" name="id" value="<?= $mhs['id'] ?>">
                <div class="w-full">
                    <label class="label">
                        <span class="label-text text-sm text-black">Nama</span>
                    </label>
                    <input type="text" placeholder="Masukkan nama" value="<?= $mhs['nama'] ?>" name="nama" class="input input-sm  bg-white text-slate-900  border border-black/50 input-bordered w-full" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label w-16">
                        <span class="label-text text-sm text-black">NIM</span>
                    </label>
                    <input type="text" placeholder="Masukkan NIM" value="<?= $mhs['nim'] ?>" name="nim" class="input input-sm  bg-white text-slate-900  border border-black/50 input-bordered w-full" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="label-text text-sm text-black">Program Studi</span>
                    </label>
                    <input type="text" placeholder="text" value="<?= $mhs['program_studi'] ?>" name="programStudi" class="input input-sm  bg-white text-slate-900  border border-black/50 input-bordered w-full" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="label-text text-sm text-black">Angkatan</span>
                    </label>
                    <input type="text" placeholder="number" value="<?= $mhs['angkatan'] ?>" name="angkatan" class="input input-sm  bg-white text-slate-900  border border-black/50 input-bordered w-full" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="label-text text-sm text-black">No. Handphone</span>
                    </label>
                    <input type="text" placeholder="text" value="<?= $mhs['nomor_handphone'] ?>" name="noHp" class="input input-sm bg-white text-slate-900  border border-black/50 input-bordered w-full" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="label-text text-sm text-black">Nama Dosen</span>
                    </label>
                    <select name="idDosen" class="select w-full bg-white text-slate-900  select-sm border border-black/50 text-xs input-bordered ">
                        <?php foreach ($listDosen as $dosen) : ?>
                            <!-- selected if $dosen['id'] = $mhs['id_dosen_pa'] -->
                            <option value="<?= $dosen['id'] ?>" <?= $dosen['id'] == $mhs['id_dosen_pa'] ? 'selected' : '' ?>><?= $dosen['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="label-text text-sm text-black">Semester</span>
                    </label>
                    <input type="number" placeholder="Masukkan semester" value="<?= $mhs['semester'] ?>" name="semester" class="input input-sm bg-white text-slate-900  border border-black/50 input-bordered w-full" autofocus required />
                </div>
                <button type="submit" name="edit-mahasiswa-button" class="w-full text-white px-3 py-3 text-sm font-semibold bg-orange-500 rounded-lg">
                    Edit
                </button>
            </form>
        </div>
    </div>
</body>

</html>
