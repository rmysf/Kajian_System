<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Kajian System') }} — Organizer</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --emerald-950: #0A2E24; --emerald-900: #0C3B2E; --emerald-700: #12664B;
            --emerald-600: #178363; --emerald-500: #1FA97D; --emerald-300: #8FD8BC;
            --emerald-100: #E3F3EB; --gold: #C9A15A; --gold-soft: #F1E4C8;
            --gold-text: #7A5A1E; --cream: #F3F8F5; --ink: #12271F; --ink-soft: #5A7268;
            --bg-outer: #DCE6E1; --border-light: #E3ECE7; --border-card: #EAF2EE;
            --nav-inactive: #A9BAB2; --badge-live: #E0663F; --danger: #b8492f;
            --danger-soft: #fae9e5; --danger-text: #832f1a;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link { @apply flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors duration-150; }
        .sidebar-link.active { background: var(--emerald-100); color: var(--emerald-900); }
        .sidebar-link:not(.active) { color: var(--ink-soft); }
        .sidebar-link:not(.active):hover { background: var(--cream); color: var(--ink); }
        .sidebar-group-label { font-size: 11px; font-weight: 600; color: var(--nav-inactive); letter-spacing: .06em; text-transform: uppercase; padding: 0 12px; margin-bottom: 4px; margin-top: 20px; }
    </style>
</head>
<body class="bg-[var(--bg-outer)] text-[var(--ink)] antialiased" x-data="{ sidebarOpen: false }">

    <!-- Toast Notifications -->
    @if(session('success') || session('error'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed top-4 right-4 z-[200] flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg border text-sm font-medium max-w-sm
            {{ session('success') ? 'bg-[var(--emerald-100)] border-[var(--emerald-300)] text-[var(--emerald-900)]' : 'bg-[var(--danger-soft)] border-red-200 text-[var(--danger-text)]' }}"
    >
        <i data-lucide="{{ session('success') ? 'check-circle-2' : 'alert-circle' }}" class="w-4 h-4 flex-shrink-0"></i>
        <span>{{ session('success') ?? session('error') }}</span>
        <button @click="show = false" class="ml-auto opacity-60 hover:opacity-100"><i data-lucide="x" class="w-4 h-4"></i></button>
    </div>
    @endif

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Overlay (mobile) -->
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-black/40 lg:hidden"
            style="display:none;"
        ></div>

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col bg-white border-r border-[var(--border-light)] transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto"
        >
            <!-- Logo -->
            <div class="flex items-center gap-2.5 h-16 px-5 border-b border-[var(--border-light)] flex-shrink-0">
                <div class="w-8 h-8 rounded-xl bg-[var(--emerald-900)] flex items-center justify-center">
                    <i data-lucide="book-marked" class="w-4 h-4 text-white"></i>
                </div>
                <span class="text-base font-bold text-[var(--ink)]">Kajian<span class="text-[var(--emerald-700)]">Web</span></span>
                <span class="ml-auto text-[10px] font-semibold px-2 py-0.5 rounded-full bg-[var(--emerald-100)] text-[var(--emerald-700)]">Organizer</span>
            </div>

            <!-- Nav -->
            <nav class="flex-1 overflow-y-auto px-3 py-4">
                <p class="sidebar-group-label" style="margin-top:0;">Menu</p>

                <a href="{{ url('/organizer') }}"
                   class="sidebar-link {{ request()->is('organizer') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 flex-shrink-0"></i> Dashboard
                </a>

                <p class="sidebar-group-label">Kajian</p>

                <a href="{{ route('organizer.kajian.index') }}"
                   class="sidebar-link {{ request()->routeIs('organizer.kajian.index') ? 'active' : '' }}">
                    <i data-lucide="list" class="w-4 h-4 flex-shrink-0"></i> Daftar Kajian
                </a>
                <a href="{{ route('organizer.kajian.create') }}"
                   class="sidebar-link {{ request()->routeIs('organizer.kajian.create') ? 'active' : '' }}">
                    <i data-lucide="plus-circle" class="w-4 h-4 flex-shrink-0"></i> Tambah Kajian
                </a>

                <p class="sidebar-group-label">Lokasi</p>

                <a href="{{ route('organizer.mosque.index') }}"
                   class="sidebar-link {{ request()->routeIs('organizer.mosque.*') ? 'active' : '' }}">
                    <i data-lucide="map-pin" class="w-4 h-4 flex-shrink-0"></i> Masjid / Lokasi
                </a>
            </nav>

            <!-- User footer -->
            <div class="border-t border-[var(--border-light)] px-3 py-4 flex-shrink-0">
                @php $organizer = auth()->user()?->organizer; @endphp
                <div class="flex items-center gap-3 px-2">
                    <div class="w-9 h-9 rounded-full bg-[var(--emerald-100)] flex items-center justify-center text-[var(--emerald-700)] font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()?->name ?? 'O', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-[var(--ink)] truncate">{{ auth()->user()?->name }}</p>
                        <p class="text-[11px] text-[var(--ink-soft)] truncate flex items-center gap-1">
                            @if($organizer?->is_verified)
                                <i data-lucide="badge-check" class="w-3 h-3 text-[var(--gold)]"></i> Terverifikasi
                            @else
                                <i data-lucide="clock" class="w-3 h-3"></i> Menunggu Verifikasi
                            @endif
                        </p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="sidebar-link w-full text-left text-[var(--danger)] hover:bg-[var(--danger-soft)]">
                        <i data-lucide="log-out" class="w-4 h-4 flex-shrink-0"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            <!-- Topbar -->
            <header class="flex items-center gap-4 h-16 px-4 lg:px-6 bg-white border-b border-[var(--border-light)] flex-shrink-0">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-xl text-[var(--ink-soft)] hover:bg-[var(--cream)] lg:hidden">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>

                @isset($header)
                <div class="min-w-0">
                    <h1 class="text-base font-semibold text-[var(--ink)] truncate">{{ $header }}</h1>
                </div>
                @endisset

                <div class="flex items-center gap-2 ml-auto">
                    <span class="hidden sm:block text-sm text-[var(--ink-soft)]">{{ auth()->user()?->name }}</span>
                </div>
            </header>

            <!-- Page -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
        document.addEventListener('alpine:initialized', () => lucide.createIcons());
    </script>
</body>
</html>
