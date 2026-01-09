<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once __DIR__ . '/../vendor/autoload.php';

use Ycode\AirBnb\Controllers\RentalController;

$controller = new RentalController;


$data = $controller->index();

$listings = $data['rentals'];
$currentPage = $data['currentPage'];
$totalPages = $data['totalPages'];
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

    <main class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20">

        <?php if (empty($listings)): ?>
            <div class="text-center py-20">
                <h2 class="text-2xl font-bold text-gray-800">No rentals found</h2>
                <p class="text-gray-500 mt-2">Be the first to host a place!</p>
            </div>
        <?php else: ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-10">
                <?php foreach ($listings as $rental): ?>

                    <div class="group relative block cursor-pointer">

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form action="../controllers/favoritesController.php" method="POST" class="absolute top-3 right-3 z-20">
                                <input type="hidden" name="action" value="toggle_favorite">
                                <input type="hidden" name="rental_id" value="<?= $rental['id'] ?>">

                                <button type="submit" class="text-white/70 hover:scale-110 transition hover:text-rose-500">
                                    <i class="fa-regular fa-heart text-2xl drop-shadow-lg"></i>
                                </button>
                            </form>
                        <?php endif; ?>

                        <a href="details.php?id=<?= $rental['id'] ?>" class="block z-10">

                            <div class="relative aspect-[20/19] overflow-hidden rounded-xl bg-gray-200 mb-3">
                                <img src="../<?= $rental['image'] ?>" alt="<?= htmlspecialchars($rental['title']) ?>" class="h-full w-full object-cover group-hover:scale-105 transition duration-300">

                                <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-xs font-bold shadow-sm">
                                    Guest favorite
                                </div>
                            </div>

                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-gray-900 leading-tight"><?= htmlspecialchars($rental['title']) ?></h3>
                                    <p class="text-gray-500 text-sm mt-1"><?= htmlspecialchars($rental['city']) ?></p>
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

                    </div>

                <?php endforeach; ?>
            </div>

            <div class="mt-12 flex justify-center items-center gap-4 border-t border-gray-100 pt-8">

                <?php if ($currentPage > 1): ?>
                    <a href="?page=<?= $currentPage - 1 ?>" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm font-semibold text-gray-700">
                        <i class="fa-solid fa-chevron-left mr-2"></i> Previous
                    </a>
                <?php endif; ?>

                <span class="text-gray-500 text-sm font-medium">
                    Page <?= $currentPage ?> of <?= $totalPages ?>
                </span>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $currentPage + 1 ?>" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm font-semibold text-gray-700">
                        Next <i class="fa-solid fa-chevron-right ml-2"></i>
                    </a>
                <?php endif; ?>

            </div>

        <?php endif; ?>

    </main>
    <?php include('partials/navbar.php') ?>

</body>

</html>