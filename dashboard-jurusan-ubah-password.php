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
    <title>Ubah password</title>
</head>

<body class="bg-gray-50">
    <?php include 'navbar.php' ?>

    <div class="flex gap-5">
        <?php include 'sidebar-jurusan.php' ?>

        <div class="mx-auto mt-12">
            <h1 class="font-bold text-center text-slate-900">Ubah password</h1>
            <form method="post" action="services/change-password.php" enctype="multipart/form-data" class="w-[400px] flex flex-col gap-3 mt-5 border border-1 p-5 shadow-xl shadow-orange-300/80 border-black rounded-xl">
                <input type="hidden" value="<?= $userLogin['id'] ?>" name="id" />
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Foto Profil</span>
                    </label>
                    <input accept="image/*" name="image" type="file" class="w-full max-w-xs rounded-full file-input " />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Nama</span>
                    </label>
                    <input type="text" placeholder="Masukkan nama" value="<?= $userLogin['nama'] ?>" name="nama" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="w-16 label">
                        <span class="text-sm text-black label-text">Jabatan</span>
                    </label>
                    <input type="text" placeholder="Masukkan Jabatan" value="<?= ucfirst($userLogin['peran']) ?>" name="nip" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Password Saat ini</span>
                    </label>
                    <input type="password" placeholder="***********" name="password-old" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>

                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Password yang baru</span>
                    </label>
                    <input type="password" placeholder="***********" name="password-new" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>

                <button type="submit" name="change-password-button" class="w-full px-3 py-3 text-sm font-semibold text-white bg-orange-500 rounded-lg">
                    Ubah Password
                </button>
            </form>
        </div>
    </div>
</body>

</html>
