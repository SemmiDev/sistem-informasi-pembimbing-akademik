<?php session_start() ?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'head.php'; ?>
</head>

<body class="bg-white">
    <main class="flex flex-col w-full min-h-screen">

        <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
            <div class="bg-white p-10 w-[400px] h-[500px] rounded-3xl flex flex-col gap-5 items-center justify-center shadow-lg">
                <div class="flex justify-between w-full">
                    <div>
                        <h1 class="text-lg font-thin text-black/70">
                            Welcome to BimAkad
                        </h1>
                        <h1 class="mt-2 text-4xl font-semibold text-black">Sign In</h1>
                        <?php if (isset($_SESSION['error_login'])) { ?>
                            <div class="mt-5 shadow-lg alert alert-error">
                                <strong>Warning!</strong> <?php echo $_SESSION['error_login']; ?>
                            </div>
                        <?php } ?>
                        <?php unset($_SESSION['error_login']); ?>
                    </div>
                </div>

                <form method="post" action="services/login-process.php" class="flex flex-col w-full gap-3 mt-5">
                    <div class="w-full form-control">
                        <label class="label">
                            <span class="text-black label-text">Enter yout NIP</span>
                        </label>
                        <input type="text" placeholder="NIP" name="nip" class="w-full bg-white border input text-slate-900 border-black/50 input-bordered" autofocus required />
                    </div>

                    <div class="w-full form-control">
                        <label class="label">
                            <span class="text-black label-text">Enter your password</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Password" class="w-full bg-white border input text-slate-900 border-black/50 input-bordered" required />
                            <div class="absolute right-3 top-3" onclick="changeInputType()">
                                <span class="material-symbols-outlined hover:cursor-pointer" id="password-indicator">
                                    visibility
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="login" class="w-full px-3 py-3 text-sm font-semibold text-white bg-orange-500 rounded-lg">
                        Sign In
                    </button>
                </form>
            </div>
        </div>


        <!-- absolute logo on the right -->
        <div class="absolute top-5 right-5">
            <img src="./images/logo.png" class="object-cover w-60" />
        </div>

        <div class="grid grid-cols-2">
            <div class="w-full min-h-screen flex items-center justify-center bg-[#ECBC76]">
                <img src="./images/Saly-3.png" />
            </div>
            <div class="bg-[#F5F5F5] w-full min-h-screen flex items-center justify-center">
                <img src="./images/Saly-2.png" />
            </div>
        </div>
    </main>


    <script src="script.js"></script>
</body>

</html>
