<aside class="w-64" aria-label="Sidebar" id="sidebar-jurusan">
    <div class="min-h-screen px-3 py-4 overflow-y-auto bg-white rounded dark:bg-gray-800">
        <div class="flex flex-col items-center justify-center w-full gap-2 mx-auto mt-8 mb-8 place-content-center">
            <?php if ($userLogin['foto_profile']) { ?>
                <img class="object-cover w-12 h-12 rounded-full" src="./uploads/<?= $userLogin['foto_profile'] ?>" alt="profile">
            <?php } else { ?>
                <img class="object-cover w-12 h-12 rounded-full" src="./images/avatar.png" alt="">
            <?php }  ?>
            <span class="ml-3">Dashboard</span>
            <h1 class="text-sm font-bold text-slate-900"><?= $userLogin['nama'] ?></h1>
            <button class="px-2 text-sm py-2 rounded-lg bg-[#6FCF97]/20 text-green-500"><?= ucfirst($userLogin['peran']) ?></button>
        </div>

        <ul class="space-y-2">
            <li>
                <a href="dashboard-jurusan.php" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="./images/dashboard.png" class="w-6 h-6">
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="dashboard-jurusan-mahasiswa.php" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="./images/daftar-mhs.png" class="w-6 h-6">
                    <span class="ml-3">Daftar Mahasiswa</span>
                </a>
            </li>
            <li>
                <a href="dashboard-jurusan-dosen.php" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="./images/daftar-dosen.png" class="w-6 h-6">
                    <span class="ml-3">Daftar Dosen</span>
                </a>
            </li>
            <li>
                <a href="dashboard-jurusan-riwayat-bimbingan.php" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="./images/report.png" class="w-6 h-6">
                    <span class="ml-3">Riwayat Bimbingan</span>
                </a>
            </li>
            <li>
                <a href="dashboard-jurusan-ubah-password.php" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="./images/ubah-password.png" class="w-6 h-6">
                    <span class="ml-3">Ubah password</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <img src="./images/logout.png" class="w-6 h-6">
                    Logout
                </a>
            </li>
        </ul>

    </div>
</aside>
