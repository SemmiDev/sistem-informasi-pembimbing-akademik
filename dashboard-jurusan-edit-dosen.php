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
    <title>Edit Data Dosen</title>
</head>

<body class="bg-gray-50">
    <?php include 'navbar.php' ?>

    <?php

    include 'config.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM pengguna WHERE peran='dosen' AND id='$id'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $dosen = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="flex gap-5">
        <?php include 'sidebar-jurusan.php' ?>

        <div class="mx-auto mt-12">
            <form method="post" action="services/edit-dosen-process.php" class="w-[400px] flex flex-col gap-3 mt-5 border border-1 p-5 shadow-xl shadow-orange-300/80 border-black rounded-xl">
                <h1 class="font-bold text-center text-slate-900">Edit Data Dosen</h1>
                <input type="hidden" name="id" value="<?php echo $dosen['id'] ?>">
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Nama</span>
                    </label>
                    <input type="text" value="<?php echo $dosen['nama'] ?>" placeholder="Masukkan nama" name="nama" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="w-16 label">
                        <span class="text-sm text-black label-text">NIP</span>
                    </label>
                    <input type="text" value="<?php echo $dosen['nip'] ?>" placeholder="Masukkan NIP" name="nip" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>
                <div class="w-full">
                    <label class="label">
                        <span class="text-sm text-black label-text">Password</span>
                    </label>
                    <input type="text" value="<?php echo $dosen['password'] ?>" placeholder="***********" name="password" class="w-full bg-white border input input-sm text-slate-900 border-black/50 input-bordered" autofocus required />
                </div>

                <button type="submit" name="edit-dosen-button" class="w-full px-3 py-3 text-sm font-semibold text-white bg-orange-500 rounded-lg">
                    Edit
                </button>
            </form>
        </div>
    </div>
</body>

</html>
