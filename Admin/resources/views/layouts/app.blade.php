<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="hidden md:flex w-72 flex-shrink-0 fixed h-screen">
            <div class="flex flex-col w-72 h-full" style="background-color: #f3efec">
                <div class="flex flex-col flex-grow pt-8 overflow-y-auto">
                    <div class="px-6">
                        <h1 class="text-2xl font-semibold text-gray-800">Admin Dashboard</h1>
                    </div>
                    <nav class="flex-1 px-2 mt-8 space-y-2">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Menu</p>
                        <a href="{{ url('products') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ Request::is('products') ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-700 hover:bg-white hover:shadow-sm' }} transition-all duration-200">
                            <i class="fas fa-home mr-2 flex-shrink-0 h-4 w-5"></i>
                            Products
                        </a>
                        <a href="{{ url('inputdata') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ Request::is('inputdata') ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-700 hover:bg-white hover:shadow-sm' }} transition-all duration-200">
                            <i class="fas fa-users mr-2 flex-shrink-0 h-4 w-5"></i>
                            Input Data
                        </a>
                        <a href="{{ url('history') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ Request::is('history') ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-700 hover:bg-white hover:shadow-sm' }} transition-all duration-200">
                            <i class="fas fa-history mr-2 flex-shrink-0 h-4 w-5"></i>
                            Purchase History
                        </a>

                        <a href="{{ url('queue') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ Request::is('queue') ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-700 hover:bg-white hover:shadow-sm' }} transition-all duration-200">
                            <i class="fas fa-list mr-2 flex-shrink-0 h-4 w-5"></i>
                            PO Queue
                        </a>

                    </nav>
                    <div class="p-6 border-t border-gray-200 mt-auto">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-500"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-700">Admin User</p>
                                <p class="text-xs text-gray-500">admin@example.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Main Content -->
        <div class="flex-1 md:ml-72">
            @yield('content')
        </div>
    </div>
</body>
</html>