<nav class="bg-white border-b border-gray-100 fixed w-full z-50 top-0 h-20">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">
            
            <div class="flex-shrink-0 flex items-center cursor-pointer">
                <a href="/index.php" class="text-rose-500 text-3xl">
                    <i class="fa-brands fa-airbnb"></i>
                    <span class="font-bold text-xl ml-1 hidden md:inline">airbnb</span>
                </a>
            </div>

            <div class="hidden md:flex items-center border border-gray-300 rounded-full py-2.5 px-4 shadow-sm hover:shadow-md transition cursor-pointer">
                <div class="text-sm font-semibold px-4 border-r border-gray-300">Anywhere</div>
                <div class="text-sm font-semibold px-4 border-r border-gray-300">Any week</div>
                <div class="text-sm text-gray-500 px-4">Add guests</div>
                <div class="bg-rose-500 text-white p-2 rounded-full">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </div>
            </div>

            <div class="flex items-center gap-4">
                
                <?php if(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'host'): ?>
                    <a href="/views/host_dashboard.php" class="text-sm font-semibold text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-full transition">
                        Switch to hosting
                    </a>
                <?php endif; ?>

                <div class="relative">
                    <button onclick="toggleUserMenu()" class="flex items-center gap-2 border border-gray-300 rounded-full p-1 pl-3 hover:shadow-md transition cursor-pointer bg-white">
                        <i class="fa-solid fa-bars text-gray-500 text-sm"></i>
                        <div class="bg-gray-500 text-white rounded-full p-1 px-2">
                            <?php if(isset($_SESSION['name'])): ?>
                                <span class="text-xs font-bold uppercase"><?= substr($_SESSION['name'], 0, 1) ?></span>
                            <?php else: ?>
                                <i class="fa-solid fa-user text-xs"></i>
                            <?php endif; ?>
                        </div>
                    </button>

                    <div id="user-dropdown" class="absolute right-0 top-12 w-64 bg-white border border-gray-100 rounded-xl shadow-2xl hidden overflow-hidden z-50">
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <div class="py-2">
                                <a href="#" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                    <i class="fa-solid fa-suitcase mr-3 text-gray-400"></i> My Trips
                                </a>
                                <a href="#" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                    <i class="fa-regular fa-heart mr-3 text-gray-400"></i> Favorites
                                </a>
                            </div>
                            
                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'host'): ?>
                            <div class="border-t border-gray-100 py-2">
                                <a href="/views/host_dashboard.php" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                    <i class="fa-solid fa-house-laptop mr-3 text-gray-400"></i> Manage Listings
                                </a>
                            </div>
                            <?php endif; ?>

                            <div class="border-t border-gray-100 py-2">
                                <a href="/views/logout.php" class="block px-4 py-3 text-sm font-medium text-rose-500 hover:bg-rose-50 transition">Log out</a>
                            </div>
                        <?php else: ?>
                            <div class="py-2">
                                <a href="/views/login.php" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">Log in</a>
                                <a href="/views/signup.php" class="block px-4 py-3 text-sm text-gray-500 hover:bg-gray-50 transition">Sign up</a>
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
        if (!event.target.closest('button') && !event.target.closest('#user-dropdown')) {
            const menu = document.getElementById('user-dropdown');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        }
    }
</script>