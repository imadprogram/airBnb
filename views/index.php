<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Ycode\AirBnb\Controllers\RentalController;


$controller = new RentalController;
$listings = $controller->getListings();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb Clone - Vacation Rentals</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white text-gray-800">

    <!-- <nav class="bg-white border-b border-gray-100 fixed w-full z-50 top-0 h-20">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex justify-between items-center h-full">
                
                <div class="flex-shrink-0 flex items-center cursor-pointer">
                    <a href="index.php" class="text-rose-500 text-3xl">
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
                        <a href="views/host_dashboard.php" class="text-sm font-semibold text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-full transition">
                            Switch to hosting
                        </a>
                    <?php endif; ?>

                    <div class="flex items-center gap-2 border border-gray-300 rounded-full p-1 pl-3 hover:shadow-md transition cursor-pointer relative group">
                        <i class="fa-solid fa-bars text-gray-500 text-sm"></i>
                        <div class="bg-gray-500 text-white rounded-full p-1 px-2">
                            <i class="fa-solid fa-user text-xs"></i>
                        </div>

                        <div class="absolute right-0 top-12 w-48 bg-white border border-gray-100 rounded-xl shadow-xl hidden group-hover:block overflow-hidden z-50">
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <a href="#" class="block px-4 py-3 text-sm font-semibold hover:bg-gray-50">My Trips</a>
                                <a href="#" class="block px-4 py-3 text-sm hover:bg-gray-50">Account</a>
                                <div class="h-px bg-gray-200 my-1"></div>
                                <a href="views/logout.php" class="block px-4 py-3 text-sm text-rose-500 hover:bg-gray-50">Log out</a>
                            <?php else: ?>
                                <a href="views/login.php" class="block px-4 py-3 text-sm font-semibold hover:bg-gray-50">Log in</a>
                                <a href="views/signup.php" class="block px-4 py-3 text-sm hover:bg-gray-50">Sign up</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav> -->

    <main class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20">
        
        <?php if(empty($listings)): ?>
            <div class="text-center py-20">
                <h2 class="text-2xl font-bold text-gray-800">No rentals found</h2>
                <p class="text-gray-500 mt-2">Be the first to host a place!</p>
            </div>
        <?php else: ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-10">
                <?php foreach($listings as $rental): ?>
                
                <a href="views/details.php?id=<?= $rental['id'] ?>" class="group block cursor-pointer">
                    <div class="relative aspect-[20/19] overflow-hidden rounded-xl bg-gray-200 mb-3">
                        <img src="../<?= $rental['image'] ?>" alt="<?= htmlspecialchars($rental['title']) ?>" class="h-full w-full object-cover group-hover:scale-105 transition duration-300">
                        
                        <button class="absolute top-3 right-3 text-white/70 hover:scale-110 transition z-10">
                            <i class="fa-regular fa-heart text-2xl drop-shadow-lg"></i>
                        </button>

                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-xs font-bold shadow-sm">
                            Guest favorite
                        </div>
                    </div>

                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-gray-900 leading-tight"><?= htmlspecialchars($rental['title']) ?> in <?= htmlspecialchars($rental['city']) ?></h3>
                            <p class="text-gray-500 text-sm mt-1">Hosted by User #<?= $rental['host_id'] ?></p>
                            <div class="mt-2 flex items-baseline gap-1">
                                <span class="font-bold text-gray-900">$<?= htmlspecialchars($rental['price']) ?></span>
                                <span class="text-gray-900">night</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-1 text-sm">
                            <i class="fa-solid fa-star text-xs"></i>
                            <span>4.9</span>
                        </div>
                    </div>
                </a>

                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </main>
    <?php include('partials/navbar.php') ?>

</body>
</html>