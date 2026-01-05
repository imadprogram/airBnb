<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a New Home - Airbnb</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">

    <nav class="bg-white border-b border-gray-200 fixed w-full z-10 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-extrabold text-rose-600">airbnb</h1>
                </div>
                <div class="flex items-center">
                    <a href="host_dashboard.php" class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-2">
                        <i class="fa-solid fa-xmark"></i> Close
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-24 pb-12 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Publish a new listing</h1>
            <p class="text-gray-500 mt-2 text-lg">Fill in the details to publish your property to travelers worldwide.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">

            <form action="../controllers/rentalController.php" method="POST" enctype="multipart/form-data" class="space-y-8">

                <input type="hidden" name="action" value="create_rental">

                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-gray-800 pb-2 border-b border-gray-100">property Details</h2>

                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Listing Title</label>
                        <input type="text" name="title" id="title" required placeholder="e.g., Sunny Loft in Marrakech Medina"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
                        <p class="text-gray-400 text-xs mt-2">Catchy titles attract more guests.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="city" class="block text-sm font-bold text-gray-700 mb-2">City</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <input type="text" name="city" id="city" required placeholder="e.g., Agadir"
                                    class="w-full border border-gray-300 rounded-xl pl-11 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
                            </div>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-bold text-gray-700 mb-2">Price per Night ($)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold">
                                    $
                                </span>
                                <input type="number" name="price" id="price" required min="1" step="0.01" placeholder="0.00"
                                    class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 pt-6">
                    <h2 class="text-xl font-bold text-gray-800 pb-2 border-b border-gray-100">Photos</h2>

                    <div>
                        <span class="block text-sm font-bold text-gray-700 mb-2">Cover Image</span>

                        <label id="upload-box" for="file-upload" class="mt-2 flex justify-center rounded-xl border-2 border-dashed border-gray-300 px-6 pt-10 pb-12 hover:border-rose-400 transition bg-gray-50 hover:bg-gray-100 cursor-pointer group">
                            <div class="text-center space-y-2">
                                <div class="text-gray-400 group-hover:text-rose-500 transition text-4xl">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <span class="font-medium text-rose-600 hover:text-rose-500">Upload a file</span>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG up to 5MB</p>
                            </div>
                            <input id="file-upload" name="image" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)">
                        </label>

                        <div id="preview-container" class="hidden mt-2 relative rounded-xl border border-gray-200 shadow-sm overflow-hidden group">
                            <img id="image-preview" src="#" alt="Selected Image" class="w-full h-64 object-cover">

                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <button type="button" onclick="removeImage()" class="bg-white text-rose-600 font-bold py-2 px-4 rounded-full shadow-lg hover:bg-gray-100 transform hover:scale-105 transition">
                                    <i class="fa-solid fa-trash mr-2"></i> Change Image
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-4 rounded-xl text-lg transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5 active:scale-[0.98]">
                        Publish Listing Now
                    </button>
                    <p class="text-center text-gray-500 text-sm mt-4">You can edit this listing later from your dashboard.</p>
                </div>

            </form>
        </div>
    </div>

</body>
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('preview-container');
        const uploadBox = document.getElementById('upload-box');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Set the image source to the file's data
                preview.src = e.target.result;

                // Hide Upload Box, Show Preview
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

        // Reset the input value so user can select same file again if they want
        input.value = "";

        // Hide Preview, Show Upload Box
        previewContainer.classList.add('hidden');
        uploadBox.classList.remove('hidden');
    }
</script>

</html>