<nav class="bg-[#ECBC76] border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900" id="navigation">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <a href="index.php" class="flex items-center">
            <img src="./images/logo-small.png" class="h-6 mr-3 sm:h-9" alt="uin Logo" />
            <span class="self-center text-xl font-semibold text-green-500 whitespace-nowrap dark:text-white">BimAkad</span>
        </a>
        <div class="flex items-center md:order-2">
            <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <?php if ($userLogin['foto_profile']) { ?>
                    <img class="object-cover rounded-full w-9 h-9" src="./uploads/<?= $userLogin['foto_profile'] ?>" alt="profile">
                <?php } else { ?>
                    <img class="object-cover rounded-full w-9 h-9" src="./images/avatar.png" alt="">
                <?php }  ?>
            </button>
        </div>
    </div>
</nav>
