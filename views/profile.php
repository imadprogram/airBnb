<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Airbnb Clone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    <?php include 'partials/navbar.php'; ?>

    <main class="max-w-[1120px] mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Account Settings</h1>
            <p class="text-gray-500 mt-1">Manage your personal info and security preferences.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 text-center relative overflow-hidden">
                    
                    <div class="absolute top-0 left-0 w-full h-24 bg-rose-50"></div>

                    <div class="relative mt-8 mb-4">
                        <div class="w-32 h-32 mx-auto rounded-full border-4 border-white shadow-md overflow-hidden bg-gray-200 group">
                            <img id="profile-preview" src="https://ui-avatars.com/api/?name=Imad+User&background=0D8ABC&color=fff&size=256" alt="Profile" class="w-full h-full object-cover">
                            
                            <label for="avatar-upload" class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition cursor-pointer">
                                <i class="fa-solid fa-camera text-white text-2xl"></i>
                            </label>
                            <input type="file" id="avatar-upload" class="hidden" accept="image/*" onchange="previewAvatar(event)">
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900">Imad User</h2>
                    
                    <div class="mt-2 flex justify-center gap-2">
                        <span class="inline-flex items-center rounded-full bg-rose-100 px-3 py-1 text-xs font-medium text-rose-700 ring-1 ring-inset ring-rose-600/20">
                            Host
                        </span>
                        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                            Traveler
                        </span>
                    </div>

                    <p class="text-gray-500 text-sm mt-4">Member since Dec 2025</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-4">Identity Verification</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Email Address</span>
                            <span class="text-green-600 font-medium"><i class="fa-solid fa-check-circle mr-1"></i> Verified</span>
                        </li>
                        <li class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Phone Number</span>
                            <span class="text-gray-400">Not provided</span>
                        </li>
                    </ul>
                    <button class="w-full mt-6 border border-gray-300 text-gray-700 font-semibold py-2 rounded-lg hover:bg-gray-50 transition text-sm">
                        Add Phone Number
                    </button>
                </div>

            </div>

            <div class="lg:col-span-2 space-y-8">
                
                <form action="../controllers/UserController.php" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <input type="hidden" name="action" value="update_profile">
                    
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-lg text-gray-900">Personal Information</h3>
                        <button type="submit" class="text-rose-600 font-semibold text-sm hover:underline">Save Changes</button>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase text-gray-500">Full Name</label>
                                <input type="text" name="name" value="Imad User" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase text-gray-500">Email Address</label>
                                <input type="email" name="email" value="imad@example.com" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase text-gray-500">About</label>
                            <textarea name="bio" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition" placeholder="Tell us a little about yourself..."></textarea>
                            <p class="text-xs text-gray-400 text-right">0 / 500 characters</p>
                        </div>
                    </div>
                </form>

                <form action="../controllers/UserController.php" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <input type="hidden" name="action" value="update_password">

                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-lg text-gray-900">Login & Security</h3>
                        <button type="submit" class="text-rose-600 font-semibold text-sm hover:underline">Update Password</button>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase text-gray-500">Current Password</label>
                            <input type="password" name="current_password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase text-gray-500">New Password</label>
                                <input type="password" name="new_password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase text-gray-500">Confirm New Password</label>
                                <input type="password" name="confirm_password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <?php include 'partials/toast.php'; ?>

    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>