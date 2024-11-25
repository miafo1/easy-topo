<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to EASY-TOPO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        [x-cloak] { display: none; }
    </style>
</head>
<body class="bg-gray-100">
    <div x-data="{ currentSlide: 0 }" x-init="setInterval(() => { currentSlide = currentSlide === 4 ? 0 : currentSlide + 1 }, 5000)" class="relative overflow-hidden">
        <!-- Hero Section -->
        <header class="relative h-screen flex items-center justify-center text-white">
            <div class="absolute inset-0 z-0">
                <template x-for="(slide, index) in [
                    'easytopoimage/landsell.jpg',
                    'easytopoimage/slide1.jpg',
                    'easytopoimage/surv.png',
                    'easytopoimage/consult.jpeg',
                    'easytopoimage/notary.webp'
                ]">
                    <div
                        x-show="currentSlide === index"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        :style="`background-image: url(${slide});`"
                        class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                    ></div>
                </template>
            </div>
            <div class="relative z-10 text-center px-4">
                <h1 class="text-5xl font-bold mb-4">Welcome to EASY-TOPO</h1>
                <p class="text-xl mb-8">For all your land services: reservation, consulting, buying, selling, and surveying.</p>
                <a href="#services" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">Explore Our Services</a>
            </div>
        </header>

        <!-- Services Section -->
        <section id="services" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12">Our Services</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md transition duration-300 hover:shadow-xl">
                        <h3 class="text-xl font-semibold mb-4">Land Reservation</h3>
                        <p>Reserve your perfect plot with confidence and ease.</p>
                    </div>
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md transition duration-300 hover:shadow-xl">
                        <h3 class="text-xl font-semibold mb-4">Land Consultation</h3>
                        <p>Expert advice on all aspects of land acquisition and management.</p>
                    </div>
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md transition duration-300 hover:shadow-xl">
                        <h3 class="text-xl font-semibold mb-4">Surveyor Booking</h3>
                        <p>Connect with qualified surveyors for precise land measurements.</p>
                    </div>
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md transition duration-300 hover:shadow-xl">
                        <h3 class="text-xl font-semibold mb-4">Notary Services</h3>
                        <p>Ensure all your land transactions are legally sound and properly documented.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Registration & Login Section -->
        <section class="py-16 bg-gray-200">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                        <h2 class="text-3xl font-bold mb-6">Register</h2>
                        <form name="" method="POST" action="registercode.php" class="bg-white p-6 rounded-lg shadow-md">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="fname">First Name</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fname" type="text" name="fname" required placeholder="Enter your first name">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="lname">Last Name</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lname" type="text" name="lname" required placeholder="Enter your last name">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" required placeholder="Enter your email">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">Telephone Number</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone" type="tel" name="telephone" required placeholder="Enter your telephone number">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" required placeholder="Enter password">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="cpassword">Confirm Password</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="cpassword" type="password" name="cpassword" required placeholder="Confirm password">
                            </div>
                            <div class="flex items-center justify-center">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300" type="submit" name="register_btn">
                                    Sign Up
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-1/2 px-4">
                        <h2 class="text-3xl font-bold mb-6">Login</h2>
                        <form name="" method="POST" action="logincode.php" class="bg-white p-6 rounded-lg shadow-md">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="login-email">Email</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="login-email" type="email" name="email" required placeholder="Enter your email">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="login-password">Password</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="login-password" type="password" name="password" required placeholder="Enter your password">
                            </div>
                            <div class="flex items-center justify-center">
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300" type="submit" name="login_btn">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap justify-between items-center">
                    <div class="w-full md:w-1/3 text-center md:text-left mb-4 md:mb-0">
                        <h3 class="text-2xl font-bold">EASY-TOPO</h3>
                        <p>Your trusted partner in land services</p>
                    </div>
                    <div class="w-full md:w-1/3 text-center mb-4 md:mb-0">
                        <h4 class="text-xl font-semibold mb-2">Contact Us</h4>
                        <p>Email: easytopo@gmail.com</p>
                        <p>Tel: +237 654-89-73-42</p>
                    </div>
                    <div class="w-full md:w-1/3 text-center md:text-right">
                        <h4 class="text-xl font-semibold mb-2">Follow Us</h4>
                        <div class="flex justify-center md:justify-end space-x-4">
                            <a href="#" class="hover:text-blue-400 transition duration-300">Facebook</a>
                            <a href="#" class="hover:text-blue-400 transition duration-300">Twitter</a>
                            <a href="#" class="hover:text-blue-400 transition duration-300">LinkedIn</a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <p>&copy; 2024 EASY-TOPO. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <?php include('message.php'); ?>

    <script>
        // Add any additional JavaScript for animations or interactivity here
    </script>
</body>
</html>