<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Organizer</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/lucide@latest"></script>
        
        <!-- Flatpickr for Time/Date selection -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    </head>
    <body class="font-sans antialiased text-brand-ink bg-gray-50" x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebarExpanded') !== 'false' }" x-init="$watch('sidebarExpanded', val => localStorage.setItem('sidebarExpanded', val))">
        <div class="flex h-screen overflow-hidden">
            
            <div :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', sidebarExpanded ? 'w-64' : 'w-20']" class="fixed inset-y-0 left-0 z-50 bg-brand-emerald-950 text-white transition-all duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto shadow-xl flex flex-col">
                
                <div class="flex items-center justify-between h-16 border-b border-brand-emerald-900 px-4" :class="sidebarExpanded ? 'px-4' : 'px-0 justify-center'">
                    <span x-show="sidebarExpanded" class="text-xl font-bold text-white tracking-wide truncate">Penyelenggara</span>
                    <button @click="sidebarExpanded = !sidebarExpanded" class="p-1.5 rounded-lg hover:bg-brand-emerald-900 transition text-gray-300 hidden lg:block focus:outline-none" :class="sidebarExpanded ? '' : 'mx-auto'">
                        <i data-lucide="chevron-left" x-show="sidebarExpanded" class="w-5 h-5"></i>
                        <i data-lucide="chevron-right" x-show="!sidebarExpanded" class="w-5 h-5" style="display: none;"></i>
                    </button>
                </div>
                
                <nav class="p-4 space-y-1 overflow-y-auto flex-1 scrollbar-hide" :class="sidebarExpanded ? 'p-4' : 'p-2'">
                    <a href="{{ url('/organizer') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('organizer') ? 'bg-brand-emerald-900 text-white' : 'text-gray-300 hover:bg-brand-emerald-900 hover:text-white' }} transition" :title="!sidebarExpanded ? 'Dashboard' : ''" :class="sidebarExpanded ? 'justify-start' : 'justify-center px-0'">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0" :class="sidebarExpanded ? 'mr-3' : ''"></i>
                        <span x-show="sidebarExpanded" class="whitespace-nowrap">Dashboard</span>
                    </a>
                    <a href="{{ route('organizer.kajian.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('kajian.index') ? 'bg-brand-emerald-900 text-white' : 'text-gray-300 hover:bg-brand-emerald-900 hover:text-white' }} transition" :title="!sidebarExpanded ? 'Kelola Kajian' : ''" :class="sidebarExpanded ? 'justify-start' : 'justify-center px-0'">
                        <i data-lucide="book-open" class="w-5 h-5 flex-shrink-0" :class="sidebarExpanded ? 'mr-3' : ''"></i>
                        <span x-show="sidebarExpanded" class="whitespace-nowrap">Kelola Kajian</span>
                    </a>
                    <a href="{{ route('organizer.kajian.create') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('kajian.create') ? 'bg-brand-emerald-900 text-white' : 'text-gray-300 hover:bg-brand-emerald-900 hover:text-white' }} transition" :title="!sidebarExpanded ? 'Tambah Kajian' : ''" :class="sidebarExpanded ? 'justify-start' : 'justify-center px-0'">
                        <i data-lucide="plus-circle" class="w-5 h-5 flex-shrink-0" :class="sidebarExpanded ? 'mr-3' : ''"></i>
                        <span x-show="sidebarExpanded" class="whitespace-nowrap">Tambah Kajian</span>
                    </a>
                    <a href="{{ route('organizer.peserta.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('organizer.peserta.index') ? 'bg-brand-emerald-900 text-white' : 'text-gray-300 hover:bg-brand-emerald-900 hover:text-white' }} transition" :title="!sidebarExpanded ? 'Peserta' : ''" :class="sidebarExpanded ? 'justify-start' : 'justify-center px-0'">
                        <i data-lucide="users" class="w-5 h-5 flex-shrink-0" :class="sidebarExpanded ? 'mr-3' : ''"></i>
                        <span x-show="sidebarExpanded" class="whitespace-nowrap">Peserta</span>
                    </a>
                    <a href="{{ route('organizer.profile.edit') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('organizer.profile.*') ? 'bg-brand-emerald-900 text-white' : 'text-gray-300 hover:bg-brand-emerald-900 hover:text-white' }} transition" :title="!sidebarExpanded ? 'Profil' : ''" :class="sidebarExpanded ? 'justify-start' : 'justify-center px-0'">
                        <i data-lucide="user" class="w-5 h-5 flex-shrink-0" :class="sidebarExpanded ? 'mr-3' : ''"></i>
                        <span x-show="sidebarExpanded" class="whitespace-nowrap">Profil</span>
                    </a>
                </nav>
            </div>

            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 lg:hidden" style="display: none;"></div>

            <div class="flex flex-col flex-1 overflow-hidden transition-all duration-300 w-full">
                <header class="flex items-center justify-between h-16 px-4 bg-white border-b border-gray-200 lg:px-8">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="p-2 text-gray-500 rounded-md lg:hidden hover:bg-gray-100 hover:text-gray-700">
                            <i data-lucide="menu" class="w-6 h-6"></i>
                        </button>
                    </div>
                    
                    <div class="flex items-center ml-auto space-x-4">
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-brand-ink-soft hover:text-brand-danger">Logout</button>
                        </form>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto p-4 lg:p-8">


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
            document.addEventListener('alpine:initialized', () => {
                Alpine.effect(() => {
                    lucide.createIcons();
                });
            });
        </script>
    <x-toast />
    </body>
</html>


