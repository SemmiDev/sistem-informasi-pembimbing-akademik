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
                <a href="dashboard-jurusan-tambah-mahasiswa.php" class="my-5 btn btn-success">
                    Tambah Data Mahasiswa
                </a>
                <?php if (count($listMhs) == 0) { ?>
                    <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                        <strong class="font-bold">Data Kosong!</strong>
                        <span class="block sm:inline">Tidak ada data mahasiswa yang tersedia.</span>
                    </div>
                <?php } else { ?>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Kode
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        NIM
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Prodi
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Angkatan
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        No. HP
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Nama dosen
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Semester
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-center">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listMhs as $key => $mhs) : ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?= ++$key ?>
                                        </th>
                                        <td class="px-6 py-4">
                                            <?= $mhs['nim'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $mhs['nama'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $mhs['program_studi'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $mhs['angkatan'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $mhs['nomor_handphone'] ?>
                                        </td>

                                        <td class="px-6 py-4">
                                            <?= $mhs['dosen_pa'] ?>
                                        </td>

                                        <td class="px-6 py-4">
                                            <?= $mhs['semester'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="dashboard-jurusan-edit-mahasiswa.php?id=<?= $mhs['id'] ?>" class="m-1 btn btn-sm btn-warning">Edit</a>
                                            <a href="services/delete-mahasiswa-process.php?id=<?= $mhs['id'] ?>" class="m-1 btn btn-sm btn-error">Delete</a>
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
