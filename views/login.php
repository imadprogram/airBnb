<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Airbnb</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[url('https://images.pexels.com/photos/20285351/pexels-photo-20285351.jpeg?auto=compress&cs=tinysrgb&w=1920')] bg-cover bg-center bg-no-repeat h-screen flex items-center justify-center relative">

    <div class="absolute inset-0 bg-black/50"></div>

    <div class="relative z-10 bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border border-gray-100">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-rose-600">airbnb</h2>
            <p class="text-gray-500 mt-2">Welcome back</p>
        </div>
        
        <form action="../controllers/AuthController.php" method="POST" class="space-y-5">
            <input type="hidden" name="action" value="login">
            
            <div>
                <input type="email" name="email" placeholder="Email Address" required 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
            </div>
            
            <div>
                <input type="password" name="password" placeholder="Password" required 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" class="accent-rose-600 w-4 h-4 rounded border-gray-300 text-rose-600 focus:ring-rose-500">
                    <span class="ml-2 text-gray-600">Remember me</span>
                </label>
                <a href="#" class="text-rose-600 hover:underline font-medium">Forgot password?</a>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-rose-500 to-rose-600 text-white py-3.5 rounded-lg hover:from-rose-600 hover:to-rose-700 transition font-bold text-lg shadow-md transform hover:-translate-y-0.5">
                Log in
            </button>
        </form>

        <div class="mt-6 text-center pt-6 border-t border-gray-100">
            <p class="text-gray-600 text-sm">
                Don't have an account? 
                <a href="signup.php" class="text-rose-600 font-bold hover:underline">Sign up</a>
            </p>
        </div>
    </div>

</body>
</html>