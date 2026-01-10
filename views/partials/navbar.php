<nav class="bg-white border-b border-gray-100 fixed w-full z-50 top-0 h-20">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">

            <div class="flex-shrink-0 flex items-center cursor-pointer">
                <a href="../views/index.php" class="text-rose-500 text-3xl">
                    <i class="fa-brands fa-airbnb"></i>
                    <span class="font-bold text-xl ml-1 hidden md:inline">airbnb</span>
                </a>
            </div>

            <form action="../views/index.php" method="GET" class="hidden md:flex items-center border border-gray-300 rounded-full shadow-sm hover:shadow-md transition cursor-pointer h-12">
                
                <div class="pl-5 pr-2 border-r border-gray-300 h-full flex items-center">
                    <input type="text" name="city" placeholder="Anywhere" 
                           class="bg-transparent outline-none text-sm text-gray-900 placeholder-gray-500 w-28 font-semibold truncate">
                </div>

                <div class="px-3 border-r border-gray-300 h-full flex items-center gap-2">
                    <input type="number" name="min_price" placeholder="Min $" min="0" 
                           class="bg-transparent outline-none text-sm text-gray-900 placeholder-gray-500 w-16 text-center appearance-none">
                    <span class="text-gray-300">-</span>
                    <input type="number" name="max_price" placeholder="Max $" min="0" 
                           class="bg-transparent outline-none text-sm text-gray-900 placeholder-gray-500 w-16 text-center appearance-none">
                </div>

                <div class="pl-2 pr-2 h-full flex items-center">
                    <button type="submit" class="bg-rose-500 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-rose-600 transition">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </button>
                </div>

            </form>

            <div class="flex items-center gap-4">

                <div class="relative">
                    <button onclick="toggleUserMenu()" class="flex items-center gap-2 border border-gray-300 rounded-full p-1 pl-3 hover:shadow-md transition cursor-pointer bg-white">
                        <i class="fa-solid fa-bars text-gray-500 text-sm"></i>
                        <div class="bg-gray-500 text-white rounded-full p-1 px-2">
                            <?php if (isset($_SESSION['name'])): ?>
                                <span class="text-xs font-bold uppercase"><?= substr($_SESSION['name'], 0, 1) ?></span>
                            <?php else: ?>
                                <i class="fa-solid fa-user text-xs"></i>
                            <?php endif; ?>
                        </div>
                    </button>

                    <div id="user-dropdown" class="absolute right-0 top-12 w-64 bg-white border border-gray-100 rounded-xl shadow-2xl hidden overflow-hidden z-50">
                        <?php if (isset($_SESSION['user_id'])): ?>

                            <div class="py-2">
                                <a href="../views/myTrips.php" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                    <i class="fa-solid fa-suitcase mr-3 text-gray-400"></i> My Trips
                                </a>
                                <a href="../views/favorites.php" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                    <i class="fa-regular fa-heart mr-3 text-gray-400"></i> Favorites
                                </a>
                            </div>

                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'host'): ?>
                                <div class="border-t border-gray-100 py-2">
                                    <a href="host_dashboard.php" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                        <i class="fa-solid fa-house-laptop mr-3 text-gray-400"></i> Manage Listings
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="border-t border-gray-100 py-2">
                                <a href="profile.php" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                    <i class="fa-regular fa-id-card mr-3 text-gray-400"></i> My Profile
                                </a>

                                <a href="logout.php" class="block px-4 py-3 text-sm font-medium text-rose-500 hover:bg-rose-50 transition">
                                    <i class="fa-solid fa-arrow-right-from-bracket mr-3"></i> Log out
                                </a>
                            </div>

                        <?php else: ?>

                            <div class="py-2">
                                <a href="login.php" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">Log in</a>
                                <a href="signup.php" class="block px-4 py-3 text-sm text-gray-500 hover:bg-gray-50 transition">Sign up</a>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>

<script>
    function toggleUserMenu() {
        document.getElementById('user-dropdown').classList.toggle('hidden');
    }

    // Close when clicking outside
    window.onclick = function(event) {
        if (!event.target.closest('button') && !event.target.closest('#user-dropdown') && !event.target.closest('form')) {
            const menu = document.getElementById('user-dropdown');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        }
    }
</script>