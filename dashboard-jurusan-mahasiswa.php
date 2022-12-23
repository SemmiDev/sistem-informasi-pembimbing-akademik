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

    <?php

    include 'config.php';

    $sql = "SELECT mahasiswa.*, pengguna.nama AS dosen_pa FROM mahasiswa LEFT JOIN pengguna ON mahasiswa.id_dosen_pa = pengguna.id ORDER BY mahasiswa.diupdate_pada DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $listMhs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <div class="flex gap-5">
        <?php include 'sidebar-jurusan.php' ?>

        <div class="mx-auto">
            <div class="overflow-x-auto">
                <a href="dashboard-jurusan-tambah-mahasiswa.php" class="btn  btn-success my-5">
                    Tambah Data Mahasiswa
                </a>
                <?php if (count($listMhs) == 0) { ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Data Kosong!</strong>
                        <span class="block sm:inline">Tidak ada data mahasiswa yang tersedia.</span>
                    </div>
                <?php } else { ?>
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Kode
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        NIM
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Nama
                                    </th>

                                    <th scope="col" class="py-3 px-6">
                                        Prodi
                                    </th>

                                    <th scope="col" class="py-3 px-6">
                                        Angkatan
                                    </th>

                                    <th scope="col" class="py-3 px-6">
                                        No. HP
                                    </th>

                                    <th scope="col" class="py-3 px-6">
                                        Nama dosen
                                    </th>

                                    <th scope="col" class="py-3 px-6">
                                        Semester
                                    </th>

                                    <th scope="col" class="py-3 px-6 text-center">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listMhs as $key => $mhs) : ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?= ++$key ?>
                                        </th>
                                        <td class="py-4 px-6">
                                            <?= $mhs['nim'] ?>
                                        </td>
                                        <td class="py-4 px-6">
                                            <?= $mhs['nama'] ?>
                                        </td>
                                        <td class="py-4 px-6">
                                            <?= $mhs['program_studi'] ?>
                                        </td>
                                        <td class="py-4 px-6">
                                            <?= $mhs['angkatan'] ?>
                                        </td>
                                        <td class="py-4 px-6">
                                            <?= $mhs['nomor_handphone'] ?>
                                        </td>

                                        <td class="py-4 px-6">
                                            <?= $mhs['dosen_pa'] ?>
                                        </td>

                                        <td class="py-4 px-6">
                                            <?= $mhs['semester'] ?>
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="dashboard-jurusan-edit-mahasiswa.php?id=<?= $mhs['id'] ?>" class="btn btn-sm m-1 btn-warning">Edit</a>
                                            <a href="services/delete-mahasiswa-process.php?id=<?= $mhs['id'] ?>" class="btn btn-sm m-1 btn-error">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>
