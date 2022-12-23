<!DOCTYPE html>
<html>

<head>
    <?php include 'head.php'; ?>
</head>

<body class="bg-white">
    <main class="flex flex-col min-h-screen w-full">


        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="bg-white p-10 w-[450px] h-[600px] rounded-3xl flex flex-col gap-5 items-center justify-center shadow-lg">
                <div class="flex w-full justify-between">
                    <div>
                        <h1 class="text-lg font-thin text-black/70">
                            Welcome to BimAkad
                        </h1>
                        <h1 class="text-4xl font-semibold mt-2 text-black">Sign up</h1>
                    </div>

                    <div>
                        <h2 class="text-gray-400 text-sm">Have an Account?</h2>
                        <a href="login.php" class="text-orange-500 font-semibold hover:font-bold text-sm">Sign in</a>
                    </div>
                </div>

                <form method="post" action="services/register-process.php" class="w-full flex flex-col gap-3 mt-5">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-black">Enter your NIP</span>
                        </label>
                        <input type="text" placeholder="NIP" name="nip" class="input bg-white text-slate-900  border border-black/50 input-bordered w-full" autofocus required />
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text text-black">Name</span>
                            </label>
                            <input type="text" placeholder="Name" name="name" class="input bg-white text-slate-900  border border-black/50 input-bordered w-full" required />
                        </div>

                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text text-black">Contact Number</span>
                            </label>
                            <input type="text" placeholder="Contact Number" name="phoneNumber" class="input bg-white text-slate-900  border border-black/50 input-bordered w-full" required />
                        </div>
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-black">Enter your password</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Password" class="input bg-white text-slate-900  border border-black/50 input-bordered w-full" required />
                            <div class="absolute right-3 top-3" onclick="changeInputType()">
                                <span class="material-symbols-outlined hover:cursor-pointer" id="password-indicator">
                                    visibility
                                </span>
                            </div>
                        </div>
                    </div>
                    <button name="register" type="submit" class="w-full text-white px-3 py-3 text-sm font-semibold bg-orange-500 rounded-lg">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>


        <!-- absolute logo on the right -->
        <div class="absolute top-5 right-5">
            <img src="./images/logo.png" class="w-60 object-cover" />
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
