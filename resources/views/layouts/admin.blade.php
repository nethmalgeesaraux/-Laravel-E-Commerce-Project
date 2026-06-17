<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full min-h-screen">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cartify</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6', // Brand Blue
                        secondary: '#1f2937', // Dark Gray
                        sidebar: '#111827', // Darker Gray for Sidebar
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 text-gray-100 transition-transform transform -translate-x-full bg-sky-800 md:translate-x-0 md:static md:inset-0">
            <div class="flex items-center justify-center h-16 border-b border-gray-800 bg-sky-700">
                <a href="{{route('admin.index')}}"><img src="assets/images/logo.png" alt="Logo" class="h-12" /></a>
            </div>

            <div class="flex-1 py-4 overflow-y-auto">
                <nav class="px-4 space-y-2">
                    <a href="{{route('admin.index')}}" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                        <i class="w-5 text-center fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </a>

                    <p class="px-4 mt-4 mb-2 text-xs font-semibold text-gray-300 uppercase">Management</p>

                    <a href="products.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                        <i class="w-5 text-center fa-solid fa-box"></i>
                        <span>Products</span>
                    </a>

                    <a href="categories.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                        <i class="w-5 text-center fa-solid fa-layer-group"></i>
                        <span class="font-medium">Categories</span>
                    </a>

                    <a href="{{route('admin.brands')}}" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                        <i class="w-5 text-center fa-solid fa-tag"></i>
                        <span>Brands</span>
                    </a>

                    <a href="orders.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                        <i class="w-5 text-center fa-solid fa-cart-shopping"></i>
                        <span>Orders</span>
                    </a>
                    <a href="customers.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                        <i class="w-5 text-center fa-solid fa-users"></i>
                        <span>Customers</span>
                    </a>
                    <a href="reviews.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                        <i class="w-5 text-center fa-regular fa-star"></i>
                        <span>Reviews</span>
                    </a>

                    <p class="px-4 mt-4 mb-2 text-xs font-semibold text-gray-300 uppercase">Settings</p>

                    <a href="settings.php" class="nav-link flex items-center gap-3 px-4 py-2.5 text-gray-100 hover:text-white hover:bg-gray-800 rounded-lg transition">
                        <i class="w-5 text-center fa-solid fa-gear"></i>
                        <span>General Settings</span>
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-gray-800">
                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="flex items-center w-full gap-3 px-4 py-2 text-gray-100 transition rounded-lg nav-link hover:text-white hover:bg-gray-800">
                    <i class="w-5 text-center fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>

            </div>
        </aside>

        <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-black bg-opacity-50 md:hidden"></div>

        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">

            <header class="z-30 flex items-center justify-between h-16 px-6 bg-white shadow-sm">
                <button id="mobile-menu-btn" class="text-gray-500 focus:outline-none md:hidden">
                    <i class="text-2xl fa-solid fa-bars"></i>
                </button>

                <div class="items-center hidden px-3 py-2 bg-gray-100 rounded-lg md:flex w-96">
                    <i class="text-gray-400 fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search categories..." class="w-full ml-2 text-sm text-gray-600 bg-transparent border-none outline-none">
                </div>

                <div class="flex items-center gap-6">
                    <button class="relative text-gray-500 transition hover:text-primary">
                        <i class="text-xl fa-regular fa-bell"></i>
                    </button>
                    <div class="flex items-center gap-3">
                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-bold text-gray-700">{{Auth::user()->name}}</p>
                            <p class="text-xs text-gray-500">Super Admin</p>
                        </div>
                        <img src="https://i.pravatar.cc/150?img=12" alt="Admin" class="w-10 h-10 border border-gray-200 rounded-full">
                    </div>
                </div>
            </header>

            <!-- Main Content Start -->

            {{ $slot }}

            <!-- Main Content End -->

        </div>
    </div>

    <script>
        // Sidebar Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        mobileMenuBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        document.addEventListener("DOMContentLoaded", function() {
            // 1. Get the current URL filename
            const currentLocation = window.location.pathname.split("/").pop();

            // 2. Select all navigation links
            const menuLinks = document.querySelectorAll(".nav-link");

            menuLinks.forEach(link => {
                // 3. Check if link's href matches the current location
                const linkHref = link.getAttribute("href");

                if (linkHref === currentLocation) {
                    // 4. Apply Active Tailwind Classes
                    link.classList.add("bg-primary", "text-white", "shadow-md");
                    link.classList.remove("hover:bg-sky-700");

                    // 5. Optionally bold the text
                    const span = link.querySelector("span");
                    if (span) span.classList.add("font-medium");
                }
            });
        });
    </script>

</body>

</html>