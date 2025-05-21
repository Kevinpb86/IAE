<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full space-y-8 bg-white/90 backdrop-blur-lg rounded-xl shadow-2xl p-8 transform transition-all hover:scale-105 border border-white/20">
            <!-- Logo or Icon -->
            <div class="text-center">
                <div class="mx-auto w-20 h-20 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg transform hover:rotate-12 transition-transform duration-300">
                    <i class="fas fa-user-plus text-4xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mt-4 bg-gradient-to-r from-indigo-600 to-pink-600 bg-clip-text text-transparent">
                    Create Account
                </h2>
                <p class="mt-2 text-gray-600">Join us and start your journey</p>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-user text-gray-400 group-focus-within:text-indigo-500 transition-colors text-sm"></i>
                        </span>
                        <input id="name" name="name" type="text" required 
                            class="appearance-none rounded-xl relative block w-full px-3 py-2.5 pl-9 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm transition duration-150 ease-in-out hover:border-indigo-300" 
                            placeholder="Full Name"
                            value="{{ old('name') }}">
                    </div>

                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-envelope text-gray-400 group-focus-within:text-indigo-500 transition-colors text-sm"></i>
                        </span>
                        <input id="email" name="email" type="email" required 
                            class="appearance-none rounded-xl relative block w-full px-3 py-2.5 pl-9 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm transition duration-150 ease-in-out hover:border-indigo-300" 
                            placeholder="Email address"
                            value="{{ old('email') }}">
                    </div>

                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-lock text-gray-400 group-focus-within:text-indigo-500 transition-colors text-sm"></i>
                        </span>
                        <input id="password" name="password" type="password" required 
                            class="appearance-none rounded-xl relative block w-full px-3 py-2.5 pl-9 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm transition duration-150 ease-in-out hover:border-indigo-300" 
                            placeholder="Password">
                    </div>

                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-lock text-gray-400 group-focus-within:text-indigo-500 transition-colors text-sm"></i>
                        </span>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                            class="appearance-none rounded-xl relative block w-full px-3 py-2.5 pl-9 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm transition duration-150 ease-in-out hover:border-indigo-300" 
                            placeholder="Confirm Password">
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl text-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-2">
                                @foreach ($errors->all() as $error)
                                    <p class="text-red-700">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-indigo-600 hover:via-purple-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition duration-150 ease-in-out hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-user-plus text-indigo-300 group-hover:text-indigo-200 transition-colors"></i>
                        </span>
                        Create Account
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                            Sign in
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 