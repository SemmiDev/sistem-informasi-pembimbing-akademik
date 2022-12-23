<?php
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
    <title>Details</title>
    <style>
        .table {
            width: 100%;
            margin-bottom: 20px;
        }

        .table-striped tbody>tr:nth-child(odd)>td,
        .table-striped tbody>tr:nth-child(odd)>th {
            background-color: #f9f9f9;
        }

        @media print {
            #print {
                display: none;
            }
        }

        @media print {
            #PrintButton {
                display: none;
            }
        }

        @page {
            size: auto;
            /* auto is the initial value */
            margin: 0;
            /* this affects the margin in the printer settings */
        }
    </style>
</head>

<body class="bg-gray-50">
    <?php include 'navbar.php' ?>

    <?php
    include 'config.php';


    function formatDate($date)
    {
        // 2022-11-28 -> 28 Nov 2022
        $date = date_create($date);
        return date_format($date, 'd M Y');
    }

    $mhsId = $_GET['id'];

    $sql = "SELECT bimbingan.*, mahasiswa.nama AS nama, mahasiswa.nim AS nim FROM bimbingan
        JOIN mahasiswa ON bimbingan.id_mahasiswa=mahasiswa.id
        WHERE bimbingan.id_dosen=$userLogin[id] AND bimbingan.id_mahasiswa=$mhsId
        GROUP BY bimbingan.tanggal_bimbingan
        ORDER BY bimbingan.pertemuan_ke ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $listBimbingan = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="flex gap-5">
        <?php include 'sidebar-dosen.php' ?>

        <div class="mx-auto">

            <div class="flex items-center justify-between max-w-sm gap-5 p-6 mt-16 bg-transparent border rounded-lg shadow-sm border-gray-200/75 dark:bg-gray-800 dark:border-gray-700">
                <div>
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $listBimbingan[0]['nama'] ?></h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?= $listBimbingan[0]['nim'] ?></p>
                </div>
                <div onclick="PrintPage()" class="my-5 btn btn-success" id="cetak">
                    <span class="mr-2 material-symbols-outlined">
                        print
                    </span>
                    Cetak
                </div>

            </div>

            <div class="flex items-center gap-5">
                <div class="mt-12 overflow-x-auto">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        NO
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pertemuan ke-
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Hari/Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kehadiran
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Judul
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Deskripsi
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Paraf Dosen
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listBimbingan as $key => $bimbingan) : ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?= ++$key ?>
                                        </th>
                                        <td class="px-6 py-4">
                                            <?= $bimbingan['pertemuan_ke'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= formatDate($bimbingan['tanggal_bimbingan']) ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php

                                            if (!$bimbingan['hadir']) {
                                                echo "<div class='text-error'>-</div>";
                                            } else {
                                                if ($bimbingan['hadir'] == 'hadir') {
                                                    echo 'H';
                                                } else if ($bimbingan['hadir'] == 'alfa') {
                                                    echo 'A';
                                                } else if ($bimbingan['hadir'] == 'izin') {
                                                    echo 'I';
                                                }
                                            }

                                            ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $bimbingan['judul'] ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?= $bimbingan['deskripsi'] ?>
                                        </td>
                                        <td class="px-10 py-8">

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function PrintPage() {
                document.getElementById("sidebar-dosen").hidden = true;
                document.getElementById("navigation").hidden = true;
                document.getElementById("cetak").classList.add("hidden");
                window.print();
                document.getElementById("sidebar-dosen").hidden = false;
                document.getElementById("navigation").hidden = false;
                document.getElementById("cetak").classList.remove("hidden");
            }
        </script>
</body>

</html>
