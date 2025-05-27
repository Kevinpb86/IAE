<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ivory: '#f3efec',
                        primary: '#000000'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-ivory font-sans">
    <!-- Header -->
    <header>
        <div class="bg-primary text-white py-2">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i> <span>+696 969 6969</span>
                    </div>
                    <div class="text-center">
                        Welcome to Our Store
                    </div>
                    <div class="flex space-x-4">
                    </div>
                </div>
            </div>
        </div>
        <nav class="bg-[#f3efec] shadow-md py-4">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center">
                    <a class="flex items-center" href="/">
                        <img src="{{ asset('images/Logo Strave.jpeg') }}" alt="Fashion Store Logo" class="h-10">
                    </a>
                    <div class="hidden md:flex items-center space-x-6 flex-1 justify-center ml-32">
                        <a href="#" class="font-medium text-primary hover:text-gray-600">Home</a>
                        <a href="#" class="font-medium text-gray-700 hover:text-primary">About</a>
                        <a href="#" class="font-medium text-gray-700 hover:text-primary">Shop</a>
                        <a href="#" class="font-medium text-gray-700 hover:text-primary">Pages</a>
                        <a href="#" class="font-medium text-gray-700 hover:text-primary">Blog</a>
                        <a href="#" class="font-medium text-gray-700 hover:text-primary"><i class="fas fa-search"></i></a>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="#" class="bg-primary text-white px-6 py-2 rounded font-medium">SHOP NOW</a>
                        <a href="{{ route('login') }}" class="bg-[#f3efec] text-primary border border-primary px-6 py-2 rounded font-medium hover:bg-primary hover:text-white transition duration-300">LOGIN</a>
                        <div class="relative">
                            <a href="#"><i class="fas fa-shopping-cart text-gray-700"></i></a>
                            <span class="absolute -top-2 -right-2 bg-primary text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">0</span>
                        </div>
                    </div>
                    <div class="md:hidden">
                        <button class="text-gray-700 focus:outline-none">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">About Us</h3>
                    <p class="text-gray-400 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl eget ultricies.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="bg-gray-800 hover:bg-primary w-8 h-8 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-primary w-8 h-8 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-primary w-8 h-8 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-primary w-8 h-8 rounded-full flex items-center justify-center transition duration-300">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Information</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">My Account</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">My Account</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Order History</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Wishlist</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Newsletter</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Subscribe to Our Newsletter</h3>
                    <p class="text-gray-400 mb-4">Stay updated with our latest offers and news</p>
                    <form>
                        <div class="flex">
                            <input type="email" placeholder="Your Email Address" class="px-4 py-2 w-full rounded-l focus:outline-none">
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-r focus:outline-none">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-10 pt-6 text-center">
                <p class="text-gray-400">&copy; 2025 Fashion Store. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>