<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ycode\AirBnb\Controllers\BookingController;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$control = new BookingController;
$getall = $control->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Trips - Airbnb Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body class="bg-white text-gray-800">

    <?php include 'partials/navbar.php'; ?>

    <main class="max-w-[1120px] mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">

        <div class="mb-8 border-b border-gray-200 pb-8">
            <h1 class="text-3xl font-bold text-gray-900">Trips</h1>
            <p class="text-gray-500 mt-2">Manage your upcoming and past reservations.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($getall as $reservation): ?>
                <div class="flex flex-col bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition duration-300 group relative">

                    <div class="relative aspect-[4/3] overflow-hidden bg-gray-200">
                        <img src="../<?= $reservation['image'] ?>" alt="House" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <?php
                        $statusColor = 'bg-yellow-100 text-yellow-700 border-yellow-200';
                        $icon = 'fa-clock';

                        if ($reservation['status'] === 'confirmed') {
                            $statusColor = 'bg-green-100 text-green-700 border-green-200';
                            $icon = 'fa-circle-check';
                        } elseif ($reservation['status'] === 'cancelled') {
                            $statusColor = 'bg-red-100 text-red-700 border-red-200';
                            $icon = 'fa-circle-xmark';
                        }
                        ?>
                        <div class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide border shadow-sm flex items-center gap-2 <?= $statusColor ?>">
                        <i class="fa-solid <?= $icon ?>"></i>
                        <?= ucfirst($reservation['status']) ?>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-grow">

                        <div class="mb-4">
                            <h3 class="font-bold text-lg text-gray-900 leading-tight mb-1 truncate">
                                <?= $reservation['title'] ?>
                            </h3>
                            <p class="text-sm text-gray-500 truncate">
                                <?= $reservation['city'] ?>
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <span class="block text-xs text-gray-400 uppercase font-bold">Check-in</span>
                                <span class="font-semibold text-gray-800"><?= $reservation['check_in'] ?></span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <span class="block text-xs text-gray-400 uppercase font-bold">Check-out</span>
                                <span class="font-semibold text-gray-800"><?= $reservation['check_out'] ?></span>
                            </div>
                        </div>

                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                            <a href="details.php?id=1" class="text-sm font-semibold text-gray-900 underline hover:text-rose-500">
                                View listing
                            </a>

                            <form action="../controllers/BookingController.php" method="POST">
                                <input type="hidden" name="action" value="cancel_booking">
                                <input type="hidden" name="reservation_id" value="<?= $reservation['reservation_id'] ?>">

                                <?php if($reservation['status'] !== 'cancelled'): ?>
                                <button type="submit" class="text-sm font-semibold text-rose-500 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 px-4 py-2 rounded-lg transition">
                                    Cancel
                                </button>
                                <?php else: ?>
                                    <span class="text-sm font-semibold text-gray-400 cursor-not-allowed">Cancelled</span>
                                <?php endif; ?>
                            </form>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <?php include 'partials/toast.php'; ?>

</body>

</html>