<?php

error_reporting(0);

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
</head>

<body class="bg-gray-50">
    <?php include 'navbar.php' ?>

    <div class="flex gap-5">
        <?php include 'sidebar-dosen.php' ?>

        <?php

        include 'config.php';

        $bimbingan = [];

        $sql = "SELECT pertemuan_ke FROM bimbingan  WHERE id_dosen=$userLogin[id] ORDER BY pertemuan_ke DESC LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $totalPertemuan = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPertemuan = $totalPertemuan['pertemuan_ke'];
        function formatDate($date)
        {
            // 2022-11-28 -> 28 Nov 2022
            $date = date_create($date);
            return date_format($date, 'd M Y');
        }


        $sql = "SELECT bimbingan.*, mahasiswa.nama AS nama, mahasiswa.nim AS nim FROM bimbingan
            JOIN mahasiswa ON bimbingan.id_mahasiswa=mahasiswa.id
            WHERE bimbingan.id_dosen=$userLogin[id] GROUP BY bimbingan.id_mahasiswa";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $bimbingan = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <div class="m-20 ">

            <div class="flex items-center gap-5">
                <a href="dashboard-dosen-tambah-bimbingan.php" class="my-5 btn btn-success" id="tambah-bimbingan">
                    Tambah Bimbingan
                </a>

                <div class="my-5 btn btn-success" id="cetak" onclick="PrintPage()">
                    <span class="material-symbols-outlined">
                        print
                    </span>
                </div>
            </div>

            <div class="flex gap-2 my-5">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" rowspan="2" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" rowspan="2" class="px-6 py-3">
                                    Nama
                                </th>
                                <th scope="col" rowspan="2" class="px-6 py-3">
                                    NIM
                                </th>

                                <th scope="col" rowspan="2" colspan="<?= $totalPertemuan ?>" class="px-6 py-3 text-center">
                                    Pertemuan
                                </th>

                                <th scope="col" rowspan="2" class="px-6 py-3">
                                    Jumlah Tidak Hadir
                                </th>

                                <th scope="col" rowspan="2" class="px-6 py-3">
                                    Keterangan
                                </th>

                                <th scope="col" rowspan="2" class="px-6 py-3 text-center details">
                                    Detail
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- template -->
                            <tr class="border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th>
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4"></td>

                                <?php for ($i = 1; $i <= $totalPertemuan; $i++) : ?>
                                    <td class="w-32 text-xs font-thin text-center">
                                        <?php
                                        // query tanggal
                                        $sql = "SELECT tanggal_bimbingan FROM bimbingan WHERE id_dosen=$userLogin[id] AND pertemuan_ke=$i";
                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();
                                        $tanggal = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo "<span class='font-bold'>$i</span>";
                                        ?>
                                    </td>
                                <?php endfor; ?>

                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4 details"></td>
                            </tr>

                            <?php foreach ($bimbingan as $key => $bim) : ?>
                                <tr class="bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?= ++$key ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?= $bim['nama'] ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $bim['nim'] ?>
                                    </td>

                                    <?php $totalTidakHadir = 0; ?>
                                    <?php for ($i = 1; $i <= $totalPertemuan; $i++) : ?>
                                        <td class="text-center">
                                            <?php
                                            $sql = "SELECT hadir FROM bimbingan WHERE id_mahasiswa=$bim[id_mahasiswa] AND pertemuan_ke=$i";
                                            $stmt = $db->prepare($sql);
                                            $stmt->execute();
                                            $hadir = $stmt->fetch(PDO::FETCH_ASSOC);

                                            if (!$hadir['hadir']) {
                                                echo "<div class='text-error'>-</div>";
                                            } else {
                                                if ($hadir['hadir'] == 'hadir') {
                                                    echo 'H';
                                                } else if ($hadir['hadir'] == 'alfa') {
                                                    echo 'A';
                                                    $totalTidakHadir += 1;
                                                } else if ($hadir['hadir'] == 'izin') {
                                                    echo 'I';
                                                    $totalTidakHadir += 1;
                                                }
                                            }
                                            ?>
                                        </td>
                                    <?php endfor; ?>

                                    <td class="px-6 py-4">
                                        <?php
                                        echo $totalTidakHadir;
                                        $totalTidakHadir = 0;
                                        ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= $bim['keterangan'] ?>
                                    </td>
                                    <td class="px-6 py-4 details">
                                        <a href="dashboard-dosen-bimbingan-details.php?id=<?= $bim['id_mahasiswa'] ?>" class="m-1 btn btn-sm btn-warning">Details</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        function PrintPage() {
            document.getElementById("sidebar-dosen").hidden = true;
            document.getElementById("navigation").hidden = true;
            document.getElementById("cetak").classList.add("hidden");
            document.getElementById("tambah-bimbingan").classList.add("hidden");

            var details = document.getElementsByClassName("details");
            for (var i = 0; i < details.length; i++) {
                details[i].classList.add("hidden");
            }

            window.print();
            document.getElementById("sidebar-dosen").hidden = false;
            document.getElementById("navigation").hidden = false;
            document.getElementById("cetak").classList.remove("hidden");
            document.getElementById("tambah-bimbingan").classList.remove("hidden");

            var details = document.getElementsByClassName("details");
            for (var i = 0; i < details.length; i++) {
                details[i].classList.remove("hidden");
            }

        }
    </script>
</body>

</html>
