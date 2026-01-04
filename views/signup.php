<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Airbnb</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom style to highlight the selected role box */
        input:checked + div {
            border-color: #e11d48; /* Rose-600 */
            background-color: #fff1f2; /* Rose-50 */
            color: #e11d48;
        }
        input:checked + div svg {
            color: #e11d48;
        }
    </style>
</head>
<body class="bg-[url('https://images.pexels.com/photos/20285351/pexels-photo-20285351.jpeg?auto=compress&cs=tinysrgb&w=1920')] bg-cover bg-center bg-no-repeat h-screen flex items-center justify-center relative">

    <div class="absolute inset-0 bg-black/50"></div>

    <div class="relative z-10 bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border border-gray-100">
        
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-rose-600">airbnb</h2>
            <p class="text-gray-500 mt-2">Create your account</p>
        </div>
        
        <form action="../controllers/AuthController.php" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="register">
            
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="first_name" placeholder="First Name" required 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
                
                <input type="text" name="last_name" placeholder="Last Name" required 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
            </div>

            <input type="email" name="email" placeholder="Email Address" required 
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
            
            <input type="password" name="password" placeholder="Password" required 
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">

            <div class="pt-2">
                <p class="text-sm font-bold text-gray-700 mb-3">I want to:</p>
                <div class="grid grid-cols-2 gap-4">
                    
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="traveler" checked class="hidden">
                        <div class="border-2 border-gray-200 rounded-xl p-4 text-center hover:border-rose-300 transition h-full flex flex-col items-center justify-center gap-2 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 group-hover:text-rose-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="font-bold text-sm text-gray-600">Book a Place</span>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="host" class="hidden">
                        <div class="border-2 border-gray-200 rounded-xl p-4 text-center hover:border-rose-300 transition h-full flex flex-col items-center justify-center gap-2 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 group-hover:text-rose-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="font-bold text-sm text-gray-600">Rent my Home</span>
                        </div>
                    </label>

                </div>
            </div>

            <button type="submit" class="w-full bg-rose-600 text-white py-3.5 rounded-lg hover:bg-rose-700 transition font-bold text-lg shadow-lg mt-2">
                Sign Up
            </button>
        </form>

        <div class="mt-6 text-center border-t border-gray-100 pt-4">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="login.php" class="text-rose-600 font-bold hover:underline">Log in</a>
            </p>
        </div>
    </div>
</body>
</html>