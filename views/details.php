<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';

use Ycode\AirBnb\Controllers\RentalController;

$controll = new RentalController;
$rental = $controll->getDetails();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunny Loft - Airbnb Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .star-anim {
            transition: transform 0.2s, color 0.2s;
        }
    </style>
</head>

<body class="bg-white text-gray-800">

    <?php include 'partials/navbar.php'; ?>

    <main class="max-w-[1120px] mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20">

        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                <?= htmlspecialchars($rental['title']) ?> in <?= htmlspecialchars($rental['city']) ?>
            </h1>
            <div class="flex flex-wrap items-center justify-between gap-4 text-sm text-gray-900 font-medium">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-star text-xs text-rose-500"></i>
                    <span>4.95</span>
                    <span class="mx-1">·</span>
                    <span class="underline cursor-pointer">18 reviews</span>
                    <span class="mx-1">·</span>
                    <span class="underline cursor-pointer"><?= $rental['city'] ?></span>
                </div>

                <div class="flex gap-4">
                    <button class="flex items-center gap-2 hover:bg-gray-100 px-4 py-2 rounded-lg transition">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i> Share
                    </button>
                    <button class="flex items-center gap-2 hover:bg-gray-100 px-4 py-2 rounded-lg transition">
                        <i class="fa-regular fa-heart"></i> Save
                    </button>
                </div>
            </div>
        </div>

        <div class="relative w-full aspect-video md:aspect-[2/1] rounded-xl overflow-hidden shadow-sm mb-12 group cursor-pointer bg-gray-200">
            <img src="../<?= $rental['image'] ?>" alt="Property Cover" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">

            <button class="absolute bottom-4 right-4 bg-white border border-gray-900 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 transition shadow-md">
                <i class="fa-solid fa-grip-dots mr-2"></i> Show all photos
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative mb-12">

            <div class="md:col-span-2 space-y-8">

                <div class="flex justify-between items-center border-b border-gray-200 pb-8">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Entire home hosted by <?= $rental['host_first_name'], ' ', $rental['host_last_name'] ?></h2>
                        <p class="text-gray-500 text-sm mt-1">4 guests · 2 bedrooms · 2 beds · 1 bath</p>
                    </div>
                    <div class="h-12 w-12 bg-gray-900 rounded-full flex items-center justify-center text-white text-xl overflow-hidden">
                        <span class="font-bold">I</span>
                    </div>
                </div>

                <div class="space-y-6 border-b border-gray-200 pb-8">
                    <div class="flex gap-4">
                        <i class="fa-solid fa-door-open text-2xl text-gray-700 mt-1"></i>
                        <div>
                            <h3 class="font-bold text-gray-900 text-base">Self check-in</h3>
                            <p class="text-gray-500 text-sm">Check yourself in with the keypad.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <i class="fa-solid fa-location-dot text-2xl text-gray-700 mt-1"></i>
                        <div>
                            <h3 class="font-bold text-gray-900 text-base">Great location</h3>
                            <p class="text-gray-500 text-sm">95% of recent guests gave the location a 5-star rating.</p>
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-200 pb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">About this place</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Relax with the whole family at this peaceful place to stay.
                        Located in the heart of the city, this loft offers stunning views
                        and modern amenities. Perfect for a weekend getaway or a long-term remote work stay.
                        <br><br>
                        The space includes a fully equipped kitchen, high-speed wifi, and a dedicated workspace.
                    </p>
                </div>

                <div class="border-b border-gray-200 pb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">What this place offers</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3 text-gray-700"><i class="fa-solid fa-wifi w-6 text-center"></i> Wifi</div>
                        <div class="flex items-center gap-3 text-gray-700"><i class="fa-solid fa-tv w-6 text-center"></i> TV</div>
                        <div class="flex items-center gap-3 text-gray-700"><i class="fa-solid fa-kitchen-set w-6 text-center"></i> Kitchen</div>
                        <div class="flex items-center gap-3 text-gray-700"><i class="fa-solid fa-square-parking w-6 text-center"></i> Free parking</div>
                        <div class="flex items-center gap-3 text-gray-700"><i class="fa-regular fa-snowflake w-6 text-center"></i> Air conditioning</div>
                    </div>
                    <button class="mt-6 border border-gray-900 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                        Show all 24 amenities
                    </button>
                </div>

            </div>

            <div class="relative">
                <div class="sticky top-32">
                    <div class="bg-white rounded-xl shadow-[0_6px_16px_rgba(0,0,0,0.12)] border border-gray-200 p-6">

                        <div class="flex justify-between items-end mb-6">
                            <div>
                                <span class="text-2xl font-bold text-gray-900">$<?= $rental['price'] ?></span>
                                <span class="text-gray-500"> night</span>
                            </div>
                            <div class="text-sm font-semibold underline text-gray-500 cursor-pointer">
                                18 reviews
                            </div>
                        </div>

                        <form action="../controllers/BookingController.php" method="POST" class="space-y-4">

                            <div class="grid grid-cols-2 border border-gray-400 rounded-lg overflow-hidden">
                                <div class="p-3 border-r border-gray-400 hover:bg-gray-50 cursor-pointer relative">
                                    <label class="block text-[10px] font-bold uppercase text-gray-800 tracking-wider">Check-in</label>
                                    <input type="date" name="check_in" class="w-full text-sm outline-none bg-transparent text-gray-600 cursor-pointer font-sans">
                                </div>
                                <div class="p-3 hover:bg-gray-50 cursor-pointer relative">
                                    <label class="block text-[10px] font-bold uppercase text-gray-800 tracking-wider">Check-out</label>
                                    <input type="date" name="check_out" class="w-full text-sm outline-none bg-transparent text-gray-600 cursor-pointer font-sans">
                                </div>
                            </div>

                            <div class="border border-gray-400 rounded-lg p-3 hover:bg-gray-50 cursor-pointer">
                                <label class="block text-[10px] font-bold uppercase text-gray-800 tracking-wider">Guests</label>
                                <select name="guests" class="w-full text-sm outline-none bg-transparent text-gray-600 cursor-pointer appearance-none">
                                    <option value="1">1 guest</option>
                                    <option value="2">2 guests</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-rose-600 text-white py-3.5 rounded-lg font-bold hover:bg-rose-700 transition shadow-md text-lg">
                                Reserve
                            </button>

                            <p class="text-center text-sm text-gray-500">You won't be charged yet</p>

                            <div class="space-y-3 pt-4 text-gray-600">
                                <div class="flex justify-between">
                                    <span class="underline">$85 x 5 nights</span>
                                    <span>$425</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="underline">Cleaning fee</span>
                                    <span>$40</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="underline">Service fee</span>
                                    <span>$85</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-4 flex justify-between font-bold text-gray-900 text-lg">
                                <span>Total before taxes</span>
                                <span>$550</span>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="border-t border-gray-200 py-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-2">
                <i class="fa-solid fa-star text-rose-500"></i> 4.95 · 18 Reviews
            </h2>

            <div class="mb-12 max-w-2xl">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Leave a Review</h3>
                <p class="text-gray-500 mb-6">Share your experience to help others.</p>

                <form action="../controllers/reviewController.php" method="POST">
                    <input type="hidden" name="action" value="add_review">
                    <input type="hidden" name="rental_id" value="<?= $rental['id'] ?>">

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Rating</label>
                        <input type="hidden" name="rating" id="rating-value" required>
                        <div class="flex gap-2 text-2xl text-gray-300 cursor-pointer" id="star-container">
                            <i class="fa-solid fa-star star-anim hover:text-rose-500 transition" data-value="1"></i>
                            <i class="fa-solid fa-star star-anim hover:text-rose-500 transition" data-value="2"></i>
                            <i class="fa-solid fa-star star-anim hover:text-rose-500 transition" data-value="3"></i>
                            <i class="fa-solid fa-star star-anim hover:text-rose-500 transition" data-value="4"></i>
                            <i class="fa-solid fa-star star-anim hover:text-rose-500 transition" data-value="5"></i>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Your Experience</label>
                        <textarea name="comment" rows="4" required class="w-full border border-gray-400 rounded-xl p-4 text-gray-900 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent bg-white resize-none" placeholder="How was your stay?"></textarea>
                    </div>

                    <div class="flex justify-start">
                        <button type="submit" class="bg-black text-white px-8 py-3 rounded-xl font-bold hover:bg-gray-800 transition shadow-md">
                            Post Review
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">

                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 bg-gray-200 rounded-full overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" alt="User" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-base">John Doe</h4>
                            <p class="text-sm text-gray-500">October 2025</p>
                        </div>
                    </div>
                    <div>
                        <div class="flex text-xs text-rose-500 mb-2">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-gray-700 leading-relaxed text-base">
                            Absolutely loved our stay here! The location was perfect for exploring the city, and the apartment itself was clean and cozy.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 bg-gray-200 rounded-full overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=random" alt="User" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-base">Jane Smith</h4>
                            <p class="text-sm text-gray-500">September 2025</p>
                        </div>
                    </div>
                    <div>
                        <div class="flex text-xs text-rose-500 mb-2">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-gray-700 leading-relaxed text-base">
                            The host was incredibly welcoming and the views from the balcony were breathtaking. Would definitely recommend to anyone visiting!
                        </p>
                    </div>
                </div>


            </div>
        </div>
        <div class="border-t border-gray-200 pt-12 mt-12">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Meet your host</h2>
            <div class="bg-gray-100 rounded-2xl p-8 max-w-xl">
                <div class="flex items-center gap-4 mb-4">
                    <div class="h-16 w-16 bg-black rounded-full text-white flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-xl">Hosted by <?= $rental['host_first_name'] ?></h3>
                        <p class="text-gray-500 text-sm"><?= $rental['host_email'] ?></p>
                    </div>
                </div>
                <div class="text-sm text-gray-600 space-y-2 mb-6">
                    <p><i class="fa-solid fa-star text-black mr-2"></i> 34 Reviews</p>
                    <p><i class="fa-solid fa-shield-halved text-black mr-2"></i> Identity verified</p>
                </div>
                <button class="border border-black bg-white px-6 py-3 rounded-lg font-bold text-sm hover:bg-gray-50 transition">
                    Contact Host
                </button>
            </div>
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('#star-container .fa-star');
            const ratingInput = document.getElementById('rating-value');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    ratingInput.value = value;
                    updateStars(value);
                });
                star.addEventListener('mouseenter', function() {
                    updateStars(this.getAttribute('data-value'));
                });
            });

            document.getElementById('star-container').addEventListener('mouseleave', function() {
                updateStars(ratingInput.value || 0);
            });

            function updateStars(value) {
                stars.forEach(s => {
                    s.classList.toggle('text-yellow-400', s.getAttribute('data-value') <= value);
                    s.classList.toggle('text-gray-300', s.getAttribute('data-value') > value);
                });
            }
        });
    </script>
</body>

</html>