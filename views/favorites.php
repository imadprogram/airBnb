<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites - Airbnb Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white text-gray-800">

    <nav class="border-b border-gray-100 h-20 flex items-center justify-center bg-white sticky top-0 z-50">
        <span class="text-gray-400 text-sm italic">Navbar goes here</span>
    </nav>

    <main class="max-w-[1120px] mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-20">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Wishlist</h1>
            <p class="text-gray-500 mt-2 text-lg">Your saved stays for future adventures.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            
            <div class="group cursor-pointer">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-gray-200 mb-3">
                    <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=800&auto=format&fit=crop" alt="Listing" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                    
                    <button class="absolute top-3 right-3 z-10 p-2 rounded-full hover:bg-gray-100/10 transition">
                        <i class="fa-solid fa-heart text-2xl text-rose-500 drop-shadow-sm hover:scale-110 transition"></i>
                    </button>
                    
                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-xs font-bold shadow-sm">
                        Superhost
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-gray-900 truncate">Modern Loft in Paris</h3>
                        <div class="flex items-center gap-1 text-sm">
                            <i class="fa-solid fa-star text-xs"></i> 4.92
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm">Paris, France</p>
                    <div class="mt-2 flex items-baseline gap-1">
                        <span class="font-bold text-gray-900">$120</span>
                        <span class="text-gray-900">night</span>
                    </div>
                </div>
            </div>

            <div class="group cursor-pointer">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-gray-200 mb-3">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=800&auto=format&fit=crop" alt="Listing" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                    
                    <button class="absolute top-3 right-3 z-10 p-2">
                        <i class="fa-solid fa-heart text-2xl text-rose-500 drop-shadow-sm hover:scale-110 transition"></i>
                    </button>
                </div>

                <div>
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-gray-900 truncate">Cozy Cottage</h3>
                        <div class="flex items-center gap-1 text-sm">
                            <i class="fa-solid fa-star text-xs"></i> 4.85
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm">Cotswolds, UK</p>
                    <div class="mt-2 flex items-baseline gap-1">
                        <span class="font-bold text-gray-900">$85</span>
                        <span class="text-gray-900">night</span>
                    </div>
                </div>
            </div>

            <div class="group cursor-pointer">
                <div class="relative aspect-square overflow-hidden rounded-xl bg-gray-200 mb-3">
                    <img src="https://images.unsplash.com/photo-1493809842364-78817add7ffb?q=80&w=800&auto=format&fit=crop" alt="Listing" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                    
                    <button class="absolute top-3 right-3 z-10 p-2">
                        <i class="fa-solid fa-heart text-2xl text-rose-500 drop-shadow-sm hover:scale-110 transition"></i>
                    </button>
                </div>

                <div>
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-gray-900 truncate">Beachfront Villa</h3>
                        <div class="flex items-center gap-1 text-sm">
                            <i class="fa-solid fa-star text-xs"></i> 5.0
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm">Malibu, California</p>
                    <div class="mt-2 flex items-baseline gap-1">
                        <span class="font-bold text-gray-900">$450</span>
                        <span class="text-gray-900">night</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="my-20 border-t border-dashed border-gray-300 relative">
            <span class="absolute top-[-12px] left-1/2 -translate-x-1/2 bg-white px-4 text-gray-400 text-sm">
                Example of Empty State
            </span>
        </div>

        <div class="flex flex-col items-start justify-center py-10 max-w-lg">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Create your first wishlist</h2>
            <p class="text-gray-500 mb-8 text-lg leading-relaxed">
                As you search, click the <i class="fa-regular fa-heart px-1"></i> icon to save your favorite places for later.
            </p>
            <a href="index.php" class="bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-lg font-semibold transition shadow-md hover:shadow-lg">
                Start exploring
            </a>
        </div>

    </main>
    <?php include('partials/navbar.php') ?>

</body>
</html>