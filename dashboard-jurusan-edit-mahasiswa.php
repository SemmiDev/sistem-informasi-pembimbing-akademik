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
                <h1 class="font-bold text-center text-slate-900">Edit Data Mahasiswa</h1>
                <!-- hidden -->
                <input type="hidden" name="id" value="<?= $mhs['id'] ?>">
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Nama</span>
                    </label>
                    <input type="text" placeholder="Masukkan nama" value="<?= $mhs['nama'] ?>" name="nama" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="w-16 label">
                        <span class="text-sm text-black label-text">NIM</span>
                    </label>
                    <input type="text" placeholder="Masukkan NIM" value="<?= $mhs['nim'] ?>" name="nim" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Program Studi</span>
                    </label>
                    <input type="text" placeholder="text" value="<?= $mhs['program_studi'] ?>" name="programStudi" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Angkatan</span>
                    </label>
                    <input type="text" placeholder="number" value="<?= $mhs['angkatan'] ?>" name="angkatan" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">No. Handphone</span>
                    </label>
                    <input type="text" placeholder="text" value="<?= $mhs['nomor_handphone'] ?>" name="noHp" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Nama Dosen</span>
                    </label>
                    <select name="idDosen" class="w-full text-xs bg-white border select text-slate-900 select-sm border-black/50 input-bordered ">
                        <?php foreach ($listDosen as $dosen) : ?>
                            <!-- selected if $dosen['id'] = $mhs['id_dosen_pa'] -->
                            <option value="<?= $dosen['id'] ?>" <?= $dosen['id'] == $mhs['id_dosen_pa'] ? 'selected' : '' ?>><?= $dosen['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Semester</span>
                    </label>
                    <input type="number" placeholder="Masukkan semester" value="<?= $mhs['semester'] ?>" name="semester" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <button type="submit" name="edit-mahasiswa-button" class="w-full px-3 py-3 text-sm font-semibold text-white bg-orange-500 rounded-lg">
                    Edit
                </button>
            </form>
        </div>
    </div>
</body>

</html>
