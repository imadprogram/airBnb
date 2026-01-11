<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Ycode\AirBnb\Controllers\AdminController;
use Ycode\AirBnb\Repositories\AdminRepository;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$controll = new AdminController;

$stats = $controll->dashboard();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Airbnb Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="min-h-screen flex">

        <aside class="w-64 bg-slate-900 text-white fixed h-full hidden md:block z-50">
            <div class="h-20 flex items-center px-8 border-b border-slate-800">
                <a href="../views/index.php" class="text-rose-500 text-2xl font-bold">
                    <i class="fa-brands fa-airbnb mr-2"></i> Admin
                </a>
            </div>
            <nav class="mt-8 px-4 space-y-2">
                <a href="#dashboard" class="flex items-center px-4 py-3 bg-rose-600 rounded-lg text-white transition">
                    <i class="fa-solid fa-chart-line w-6"></i> Dashboard
                </a>
                <a href="#users" class="flex items-center px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition">
                    <i class="fa-solid fa-users w-6"></i> Users
                </a>
                <a href="#listings" class="flex items-center px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition">
                    <i class="fa-solid fa-home w-6"></i> Listings
                </a>
                <a href="#bookings" class="flex items-center px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition">
                    <i class="fa-solid fa-calendar-check w-6"></i> Reservations
                </a>
                <div class="pt-8 border-t border-slate-800 mt-8">
                    <a href="../views/logout.php" class="flex items-center px-4 py-3 text-rose-400 hover:text-rose-300 transition">
                        <i class="fa-solid fa-arrow-right-from-bracket w-6"></i> Logout
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1 md:ml-64 p-8">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
                <div class="flex items-center gap-3">
                    <div class="bg-white p-2 rounded-full shadow-sm border border-gray-200">
                        <i class="fa-solid fa-user-shield text-gray-500"></i>
                    </div>
                    <span class="font-semibold text-sm">Administrator</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Users</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1"><?= $stats['stats']['totalUsers'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Listings</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1"><?= $stats['stats']['totalRentals'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-50 rounded-full flex items-center justify-center text-purple-600">
                        <i class="fa-solid fa-home text-xl"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Reservations</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1"><?= $stats['stats']['totalReservations'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center text-orange-600">
                        <i class="fa-solid fa-calendar-check text-xl"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Revenue</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">$45,200</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center text-green-600">
                        <i class="fa-solid fa-dollar-sign text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-10 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900">Top 10 Most Profitable Listings</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-500">
                            <tr>
                                <th class="px-6 py-4">Listing</th>
                                <th class="px-6 py-4">Host</th>
                                <th class="px-6 py-4">Total Bookings</th>
                                <th class="px-6 py-4 text-right">Revenue Generated</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Luxury Villa in Bali</td>
                                <td class="px-6 py-4">John Doe</td>
                                <td class="px-6 py-4">45</td>
                                <td class="px-6 py-4 text-right font-bold text-green-600">$12,400</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- here -->
            <div id="users" class="bg-white rounded-xl border border-gray-200 shadow-sm mb-10 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-900">Manage Users</h2>
                </div>

                <div class="overflow-x-auto overflow-y-auto max-h-96">
                    <table class="w-full text-left text-sm text-gray-600">

                        <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-500 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-4 bg-gray-50">User</th>
                                <th class="px-6 py-4 bg-gray-50">Role</th>
                                <th class="px-6 py-4 bg-gray-50">Status</th>
                                <th class="px-6 py-4 text-right bg-gray-50">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">

                            <?php foreach ($stats['allusers'] as $users): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900"><?= $users['first_name'] . ' ' . $users['last_name'] ?></div>
                                        <div class="text-xs text-gray-500"><?= $users['email'] ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if ($users['role'] === 'admin'): ?>
                                            <span class="bg-purple-100 text-purple-700 py-1 px-3 rounded-full text-xs font-bold">Admin</span>
                                        <?php elseif ($users['role'] === 'host'): ?>
                                            <span class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full text-xs font-bold">Host</span>
                                        <?php else: ?>
                                            <span class="bg-gray-100 text-gray-700 py-1 px-3 rounded-full text-xs font-bold">Traveler</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if (isset($users['status']) && $users['status'] == 'banned'): ?>
                                            <span class="bg-red-100 text-red-700 py-1 px-3 rounded-full text-xs font-bold">Banned</span>
                                        <?php else: ?>
                                            <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs font-bold">Active</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="../controllers/AdminController.php" method="POST">
                                            <input type="hidden" name="user_id" value="<?= $users['id'] ?>">

                                            <?php if (isset($users['status']) && $users['status'] == 'banned'): ?>
                                                <input type="hidden" name="action" value="activate_user">
                                                <button type="submit" class="text-green-600 hover:text-green-800 font-medium text-xs border border-green-200 bg-green-50 px-3 py-1 rounded hover:bg-green-100 transition">
                                                    Activate
                                                </button>
                                            <?php else: ?>
                                                <input type="hidden" name="action" value="suspend_user">
                                                <button type="submit" class="text-rose-500 hover:text-rose-700 font-medium text-xs border border-rose-200 bg-rose-50 px-3 py-1 rounded hover:bg-rose-100 transition">
                                                    Suspend
                                                </button>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- here -->
            <div id="listings" class="bg-white rounded-xl border border-gray-200 shadow-sm mb-10 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900">Manage Listings</h2>
                </div>

                <div class="overflow-x-auto overflow-y-auto max-h-96">
                    <table class="w-full text-left text-sm text-gray-600">

                        <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-500 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-4 bg-gray-50">Listing</th>
                                <th class="px-6 py-4 bg-gray-50">Host</th>
                                <th class="px-6 py-4 bg-gray-50">Status</th>
                                <th class="px-6 py-4 text-right bg-gray-50">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            <?php foreach ($stats['listings'] as $rental): ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <?= htmlspecialchars($rental['title']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= htmlspecialchars($rental['first_name'] . ' ' . $rental['last_name']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs font-bold">Visible</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="../controllers/AdminController.php" method="POST" onsubmit="return confirm('Are you sure you want to hide this listing?');">
                                            <input type="hidden" name="action" value="hide_listing">
                                            <input type="hidden" name="rental_id" value="<?= $rental['id'] ?>">
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 font-medium text-xs border border-rose-200 bg-rose-50 px-3 py-1 rounded hover:bg-rose-100 transition">
                                                Hide Listing
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- here -->
            <div id="bookings" class="bg-white rounded-xl border border-gray-200 shadow-sm mb-10 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900">Manage Reservations</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-500">
                            <tr>
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Listing</th>
                                <th class="px-6 py-4">Dates</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">#5521</td>
                                <td class="px-6 py-4">Beach House</td>
                                <td class="px-6 py-4">Oct 12 - Oct 15</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs font-bold">Confirmed</span></td>
                                <td class="px-6 py-4 text-right">
                                    <form action="../controllers/AdminController.php" method="POST" onsubmit="return confirm('Force cancel this reservation?');">
                                        <input type="hidden" name="action" value="cancel_reservation">
                                        <input type="hidden" name="reservation_id" value="5521">
                                        <button type="submit" class="text-rose-500 hover:text-rose-700 font-medium text-xs underline decoration-rose-200 hover:decoration-rose-500 transition">
                                            Force Cancel
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>

</html>