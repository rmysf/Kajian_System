<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Organizer</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body class="font-sans antialiased text-brand-ink bg-gray-50" x-data="{ sidebarOpen: false }">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto">
                <div class="flex items-center justify-center h-16 border-b border-gray-200 px-4">
                    <span class="text-xl font-bold text-brand-emerald-900">Penyelenggara</span>
                </div>
                <nav class="p-4 space-y-1">
                    <a href="{{ url('/organizer') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('organizer') ? 'bg-brand-emerald-100 text-brand-emerald-950' : 'text-brand-ink-soft hover:bg-gray-100 hover:text-brand-ink' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i> Dashboard
                    </a>
                    <a href="{{ route('organizer.kajian.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('kajian.index') ? 'bg-brand-emerald-100 text-brand-emerald-950' : 'text-brand-ink-soft hover:bg-gray-100 hover:text-brand-ink' }}">
                        <i data-lucide="book-open" class="w-5 h-5 mr-3"></i> Kajian
                    </a>
                    <a href="{{ route('organizer.kajian.create') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('kajian.create') ? 'bg-brand-emerald-100 text-brand-emerald-950' : 'text-brand-ink-soft hover:bg-gray-100 hover:text-brand-ink' }}">
                        <i data-lucide="plus-circle" class="w-5 h-5 mr-3"></i> Tambah Kajian
                    </a>
                    <a href="{{ url('/organizer/kajian/1/peserta') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('organizer/kajian/*/peserta') ? 'bg-brand-emerald-100 text-brand-emerald-950' : 'text-brand-ink-soft hover:bg-gray-100 hover:text-brand-ink' }}">
                        <i data-lucide="users" class="w-5 h-5 mr-3"></i> Peserta
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-brand-ink-soft hover:bg-gray-100 hover:text-brand-ink">
                        <i data-lucide="user" class="w-5 h-5 mr-3"></i> Profil Penyelenggara
                    </a>
                </nav>
            </div>

            <!-- Mobile overlay -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 lg:hidden" style="display: none;"></div>

            <!-- Main content -->
            <div class="flex flex-col flex-1 overflow-hidden">
                <!-- Top header -->
                <header class="flex items-center justify-between h-16 px-4 bg-white border-b border-gray-200 lg:px-8">
                    <button @click="sidebarOpen = true" class="p-2 text-gray-500 rounded-md lg:hidden hover:bg-gray-100 hover:text-gray-700">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    
                    <div class="flex items-center ml-auto space-x-4">
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-brand-ink-soft hover:text-brand-danger">Logout</button>
                        </form>
                    </div>
                </header>

                <!-- Page content -->
                <main class="flex-1 overflow-y-auto p-4 lg:p-8">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-brand-emerald-100 text-brand-emerald-950 rounded-lg flex items-center">
                            <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i> {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-brand-danger rounded-lg flex items-center">
                            <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i> {{ session('error') }}
                        </div>
                    @endif

                    @isset($header)
                        <div class="mb-6">
                            <h1 class="text-2xl font-bold text-brand-ink">{{ $header }}</h1>
                        </div>
                    @endisset

                    {{ $slot }}
                </main>
            </div>
        </div>

        <script>
            lucide.createIcons();
        </script>
    </body>
</html>
