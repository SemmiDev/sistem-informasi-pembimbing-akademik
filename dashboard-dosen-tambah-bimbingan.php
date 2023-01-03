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

    <?php

    include 'config.php';

    $sql = "SELECT * FROM mahasiswa WHERE id_dosen_pa=$userLogin[id]";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $listMahasiswaAsuhan =
        $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

    <div class="flex gap-5">
        <?php include 'sidebar-dosen.php' ?>

        <div class="mx-auto mt-12">
            <form method="post" action="services/tambah-bimbingan.php" class="w-[400px] flex flex-col gap-3 mt-5 border border-1 p-5 shadow-xl shadow-orange-300/80 border-black rounded-xl">
                <h1 class="font-bold text-center text-slate-900">
                    Tambah Data Bimbingan
                </h1>

                <input type="hidden" name="id_dosen" value="<?php echo $userLogin['id'] ?>" />

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-slate-900 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input datepicker type="text" name="tanggal_bimbingan" required class="bg-white border border-gray-300 text-gray-900
                        text-sm rounded-lg focus:ring-blue-500
                        focus:border-blue-500 block w-full pl-10 p-2.5
                        dark:bg-gray-700 dark:border-gray-600
                        dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal bimbingan">
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Mahasiswa</span>
                    </label>
                    <select name="id_mahasiswa" required class="w-full text-xs bg-white border select text-slate-900 select-sm border-black/50 input-bordered">
                        <?php foreach ($listMahasiswaAsuhan as $mhs) : ?>
                            <option value="<?= $mhs['id'] ?>">
                                <?= $mhs['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Pertemuan ke</span>
                    </label>
                    <input type="number" placeholder="Masukkan pertemuan" name="pertemuan_ke" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" required />
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Kehadiran</span>
                    </label>
                    <select name="kehadiran" required class="w-full text-xs bg-white border select text-slate-900 select-sm border-black/50 input-bordered">
                        <option value="hadir">Hadir</option>
                        <option value="alfa">Alfa</option>
                        <option value="izin">Izin</option>
                    </select>
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Judul</span>
                    </label>
                    <input type="text" placeholder="Masukkan judul" name="judul" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" />
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Deskripsi</span>
                    </label>
                    <textarea placeholder="Masukkan deskripsi" name="deskripsi" class="w-full bg-white border textarea text-slate-900 border-black/50 textarea-bordered"></textarea>
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Keterangan</span>
                    </label>
                    <textarea placeholder="Masukkan keterangan" name="keterangan" class="w-full bg-white border textarea text-slate-900 border-black/50 textarea-bordered"></textarea>
                </div>

                <button type="submit" name="tambahkan-bimbingan" class="w-full px-3 py-3 text-sm font-semibold text-white bg-orange-500 rounded-lg">
                    Tambah
                </button>
            </form>
        </div>
    </div>
</body>

</html>
