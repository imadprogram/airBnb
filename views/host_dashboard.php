<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';

use Ycode\AirBnb\Controllers\RentalController;

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'host') {
    header('Location: login.php');
    exit;
}

$rentControll = new RentalController;

$rentals = $rentControll->getRentals();

?>
<!DOCTYPE html>
<html lang="en">

<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host Dashboard - Airbnb</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body class="bg-gray-50">
    <nav class="bg-white border-b border-gray-200 fixed w-full z-10 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-extrabold text-rose-600">
                        airbnb <span class="text-gray-500 text-sm font-medium ml-2">Host Panel</span>
                    </h1>
                </div>

                <div class="flex items-center gap-6">

                    <a href="index.php" class="text-sm font-medium text-gray-500 hover:text-rose-600 transition">
                        Switch to traveling
                    </a>

                    <div class="h-6 w-px bg-gray-200"></div> <span class="hidden sm:block text-gray-700 font-medium">
                        Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>
                    </span>

                    <a href="logout.php" class="text-gray-500 hover:text-rose-600 transition flex items-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="text-sm font-semibold">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-24 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-1 space-y-6">
                <a href="add_rental.php" class="block w-full bg-rose-600 hover:bg-rose-700 text-white text-center font-bold py-3 rounded-xl transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-plus mr-2"></i> Post a New Home
                </a>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-4">Your Performance</h3>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-gray-600">Total Listings</span>
                        <span class="text-2xl font-bold text-gray-800"><?php echo count($rentals) ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Active Bookings</span>
                        <span class="text-2xl font-bold text-rose-600">5</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 space-y-8">

                <section>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">My Listings</h2>
                        <a href="#" class="text-rose-600 text-sm font-semibold hover:underline">View all</a>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[600px]">
                            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                                <tr>
                                    <th class="p-4 font-semibold">Property</th>
                                    <th class="p-4 font-semibold">Price / Night</th>
                                    <th class="p-4 font-semibold">Location</th>
                                    <th class="p-4 font-semibold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">

                                <?php if (empty($rentals)): ?>
                                    <tr>
                                        <td colspan="4" class="p-8 text-center text-gray-500">
                                            You haven't posted any listings yet.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($rentals as $rental): ?>
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="p-4 flex items-center gap-4">
                                                <img src="../<?php echo $rental['image'] ?>" alt="House" class="w-16 h-16 rounded-lg object-cover">
                                                <div>
                                                    <p class="font-bold text-gray-800"><?php echo $rental['title'] ?></p>
                                                    <p class="text-xs text-gray-500"></p>
                                                </div>
                                            </td>
                                            <td class="p-4 text-gray-700 font-medium">$<?php echo $rental['price'] ?></td>
                                            <td class="p-4 text-gray-500"><?php echo $rental['city'] ?></td>
                                            <td class="p-4 text-right space-x-2">
                                                <a href="update_rental.php?id=<?= $rental['id'] ?>" class="text-blue-500 hover:text-blue-700 font-medium text-sm">Edit</a>
                                                <button onclick="openDeleteModal(<?= $rental['id'] ?>)" class="text-red-500 hover:text-red-700 font-medium text-sm transition">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif ?>

                            </tbody>
                        </table>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Reservations</h2>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[600px]">
                            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                                <tr>
                                    <th class="p-4 font-semibold">Traveler</th>
                                    <th class="p-4 font-semibold">Property</th>
                                    <th class="p-4 font-semibold">Dates</th>
                                    <th class="p-4 font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 font-medium text-gray-800">John Doe</td>
                                    <td class="p-4 text-gray-600">Sunny Loft in Marrakech</td>
                                    <td class="p-4 text-sm text-gray-500">
                                        Oct 12 - Oct 15 <br>
                                        <span class="text-xs text-gray-400">3 Nights</span>
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs font-bold">Confirmed</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <?php include('partials/delete_modal.php') ?>
    <?php include('partials/toast.php') ?>
</body>

</html>