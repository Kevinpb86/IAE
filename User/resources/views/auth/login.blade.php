<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ivory: '#f3efec',
                        primary: '#000000',
                        'blue-primary': '#1e40af',
                        'blue-secondary': '#3b82f6'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-ivory">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-sm w-full bg-white/90 backdrop-blur-sm rounded-xl shadow-2xl p-6 transform transition-all hover:scale-105 border border-blue-100">
            <!-- Logo or Icon -->
            <div class="text-center mb-6">
                <div class="mx-auto w-20 h-20 bg-gradient-to-br from-blue-primary to-blue-secondary rounded-full flex items-center justify-center shadow-lg transform hover:rotate-12 transition-transform duration-300">
                    <i class="fas fa-user-circle text-5xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-blue-primary mt-4">
                    Welcome Back
                </h2>
                <p class="text-sm text-gray-600 mt-1">Sign in to continue</p>
            </div>

            @if (session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-xl text-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500"></i>
                        </div>
                        <div class="ml-2">
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form class="space-y-5" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-envelope text-gray-400 group-focus-within:text-blue-primary transition-colors text-sm"></i>
                        </span>
                        <input id="email" name="email" type="email" required 
                            class="appearance-none rounded-xl relative block w-full px-3 py-2.5 pl-9 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary focus:z-10 text-sm transition duration-150 ease-in-out hover:border-blue-300" 
                            placeholder="Email address"
                            value="{{ old('email') }}">
                    </div>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-lock text-gray-400 group-focus-within:text-blue-primary transition-colors text-sm"></i>
                        </span>
                        <input id="password" name="password" type="password" required 
                            class="appearance-none rounded-xl relative block w-full px-3 py-2.5 pl-9 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-blue-primary focus:z-10 text-sm transition duration-150 ease-in-out hover:border-blue-300" 
                            placeholder="Password">
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                            class="h-4 w-4 text-blue-primary focus:ring-blue-primary border-gray-300 rounded transition duration-150 ease-in-out">
                        <label for="remember_me" class="ml-2 text-gray-700">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="text-blue-primary hover:text-blue-secondary transition duration-150 ease-in-out font-medium">
                        Forgot password?
                    </a>
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
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-blue-primary to-blue-secondary hover:from-blue-600 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-primary transform transition duration-150 ease-in-out hover:scale-105 shadow-lg hover:shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt text-blue-200 group-hover:text-blue-100 transition-colors"></i>
                        </span>
                        Sign in
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-3">
                        Don't have an account?
                    </p>
                    <a href="{{ route('register') }}" 
                        class="inline-flex items-center justify-center w-full py-2.5 px-4 border border-blue-primary text-sm font-medium rounded-xl text-blue-primary bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-primary transform transition duration-150 ease-in-out hover:scale-105 hover:shadow-md">
                        <i class="fas fa-user-plus mr-2"></i>
                        Create New Account
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 