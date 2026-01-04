<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
use Ycode\AirBnb\Repositories\RentalRepository;

if(!isset($_GET['id'])){
    die('error');
}

$id = $_GET['id'];

$repo = new RentalRepository;

$rental = $repo->find($id , $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rental - Airbnb Host</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">

    <nav class="bg-white border-b border-gray-200 fixed w-full z-10 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="host_dashboard.php" class="text-2xl font-extrabold text-rose-600">
                        airbnb <span class="text-gray-500 text-sm font-medium ml-2">Edit Mode</span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="host_dashboard.php" class="text-gray-500 hover:text-gray-700 font-medium">Cancel</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-24 pb-12 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit your listing</h1>
            <p class="text-gray-500 mt-2">Update the details of your property.</p>
        </div>

        <form action="../controllers/RentalController.php" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
            
            <input type="hidden" name="action" value="update_rental">
            <input type="hidden" name="id" value="<?= $rental['id'] ?>">

            <div class="space-y-2">
                <label class="text-sm font-bold text-gray-700">Listing Title</label>
                <input type="text" name="title" required
                       value="<?= htmlspecialchars($rental['title']) ?>"
                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-rose-500 focus:ring-2 focus:ring-rose-200 outline-none transition" 
                       placeholder="e.g., Sunny Loft in Marrakech">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">City</label>
                    <div class="relative">
                        <i class="fa-solid fa-location-dot absolute left-4 top-4 text-gray-400"></i>
                        <input type="text" name="city" required
                               value="<?= htmlspecialchars($rental['city']) ?>"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-rose-500 focus:ring-2 focus:ring-rose-200 outline-none transition" 
                               placeholder="City name">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Price per Night</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-500 font-bold">$</span>
                        <input type="number" name="price" required min="1"
                               value="<?= htmlspecialchars($rental['price']) ?>"
                               class="w-full pl-8 pr-4 py-3 rounded-xl border border-gray-300 focus:border-rose-500 focus:ring-2 focus:ring-rose-200 outline-none transition" 
                               placeholder="00">
                    </div>
                </div>
            </div>

            <div class="space-y-6 pt-6 border-t border-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Photos</h2>
                
                <div>
                    <span class="block text-sm font-bold text-gray-700 mb-2">Cover Image</span>
                    <p class="text-xs text-gray-500 mb-4">Leave empty to keep the current image.</p>

                    <label id="upload-box" for="file-upload" class="hidden mt-2 flex justify-center rounded-xl border-2 border-dashed border-gray-300 px-6 pt-10 pb-12 hover:border-rose-400 transition bg-gray-50 hover:bg-gray-100 cursor-pointer group">
                        <div class="text-center space-y-2">
                            <div class="text-gray-400 group-hover:text-rose-500 transition text-4xl">
                                <i class="fa-regular fa-image"></i>
                            </div>
                            <span class="font-medium text-rose-600">Upload a new file</span>
                        </div>
                        <input id="file-upload" name="image" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)">
                    </label>

                    <div id="preview-container" class="mt-2 relative rounded-xl border border-gray-200 shadow-sm overflow-hidden group">
                        <img id="image-preview" src="../<?= htmlspecialchars($rental['image']) ?>" alt="Selected Image" class="w-full h-64 object-cover">
                        
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                            <button type="button" onclick="removeImage()" class="bg-white text-rose-600 font-bold py-2 px-4 rounded-full shadow-lg hover:bg-gray-100 transform hover:scale-105 transition">
                                <i class="fa-solid fa-pen mr-2"></i> Change Image
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                <a href="host_dashboard.php" class="text-gray-600 font-medium hover:text-gray-800">Cancel</a>
                <button type="submit" class="bg-rose-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-rose-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Save Changes
                </button>
            </div>

        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            const previewContainer = document.getElementById('preview-container');
            const uploadBox = document.getElementById('upload-box');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    uploadBox.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            const input = document.getElementById('file-upload');
            const previewContainer = document.getElementById('preview-container');
            const uploadBox = document.getElementById('upload-box');

            // Clear input so they can choose a new file
            input.value = "";
            
            // Hide preview, Show box
            previewContainer.classList.add('hidden');
            uploadBox.classList.remove('hidden');
        }
    </script>
</body>
</html>