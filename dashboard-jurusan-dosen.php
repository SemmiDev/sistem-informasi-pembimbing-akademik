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

    $sql = "SELECT * FROM pengguna WHERE peran='dosen' ORDER BY id DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $listDosen = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <div class="flex gap-5">
        <?php include 'sidebar-jurusan.php' ?>

        <div class="mx-auto">
            <div class="overflow-x-auto">
                <a href="dashboard-jurusan-tambah-dosen.php" class="my-5 btn btn-success">
                    Tambah Data Dosen
                </a>
                <?php if (count($listDosen) == 0) { ?>
                    <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                        <strong class="font-bold">Data Kosong!</strong>
                        <span class="block sm:inline">Tidak ada data dosen yang tersedia.</span>
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
                                        NIP
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total Mahasiswa Bimbingan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listDosen as $key => $dosen) : ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?= ++$key ?>
                                        </th>
                                        <td class="px-6 py-4">
                                            <?= $dosen['nip'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $dosen['nama'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php
                                            $sql = "SELECT COUNT(*) AS total_mhs_bimbingan FROM mahasiswa WHERE id_dosen_pa = '$dosen[id]'";
                                            $stmt = $db->prepare($sql);
                                            $stmt->execute();
                                            $totalMhsBimbingan = $stmt->fetch(PDO::FETCH_ASSOC);
                                            echo $totalMhsBimbingan['total_mhs_bimbingan'] . ' Orang';
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="dashboard-jurusan-edit-dosen.php?id=<?= $dosen['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <!-- show alert when delete -->
                                            <script>
                                                function confirmDelete() {
                                                    return confirm('Apakah anda yakin ingin menghapus data ini?');
                                                }
                                            </script>
                                            <a onclick="return confirmDelete()" href="services/delete-dosen-process.php?id=<?= $dosen['id'] ?>" class="btn btn-sm btn-error">Delete</a>
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
