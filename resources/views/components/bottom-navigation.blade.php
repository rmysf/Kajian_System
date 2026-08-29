<nav class="fixed bottom-0 w-full max-w-md bg-white border-t border-brand-border-card flex justify-around items-center pb-safe pt-2 px-2 z-20 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] md:hidden">
    
    <a href="{{ url('/') }}" class="flex flex-col items-center p-2 {{ request()->is('/') ? 'text-brand-emerald-900' : 'text-brand-nav-inactive' }}">
        @if(request()->is('/'))
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.06 1.06l8.69-8.69z" />
                <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.432z" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        @endif
        <span class="text-[10px] mt-1 font-medium">Beranda</span>
    </a>

    
    <a href="{{ url('/kajian') }}" class="flex flex-col items-center p-2 {{ request()->is('kajian*') ? 'text-brand-emerald-900' : 'text-brand-nav-inactive' }}">
        @if(request()->is('kajian*'))
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        @endif
        <span class="text-[10px] mt-1 font-medium">Jelajah</span>
    </a>

    
    <a href="{{ url('/tersimpan') }}" class="flex flex-col items-center p-2 {{ request()->is('tersimpan') ? 'text-brand-emerald-900' : 'text-brand-nav-inactive' }}">
        @if(request()->is('tersimpan'))
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M6.32 2.577a4.901 4.901 0 016.696-2.04 4.901 4.901 0 016.698 2.04.75.75 0 01.028.028v.118l-.022-.06c-.334.872-.88 1.637-1.579 2.235A6 6 0 0019.5 9v1.25a7.5 7.5 0 01-15 0V9a6 6 0 001.359-3.834c-.7-.598-1.245-1.363-1.579-2.235l-.022.06v-.118a.75.75 0 01.028-.028z" clip-rule="evenodd" />
              <path d="M3.53 2.56c.87.525 1.95.83 3.07.83a6.764 6.764 0 005.4-2.73 6.764 6.764 0 005.4 2.73c1.12 0 2.2-.305 3.07-.83A6.75 6.75 0 0019.5 9v1.25a7.5 7.5 0 01-15 0V9a6.75 6.75 0 00-1.07-6.44z" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
            </svg>
        @endif
        <span class="text-[10px] mt-1 font-medium">Tersimpan</span>
    </a>

    
    <a href="{{ url('/kajian-saya') }}" class="flex flex-col items-center p-2 {{ request()->is('kajian-saya') ? 'text-brand-emerald-900' : 'text-brand-nav-inactive' }}">
        @if(request()->is('kajian-saya'))
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        @endif
        <span class="text-[10px] mt-1 font-medium">Kajian Saya</span>
    </a>

    
    <a href="{{ url('/profile') }}" class="flex flex-col items-center p-2 {{ request()->routeIs('profile.edit') ? 'text-brand-emerald-900' : 'text-brand-nav-inactive' }}">
        @if(request()->routeIs('profile.edit'))
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        @endif
        <span class="text-[10px] mt-1 font-medium">Profil</span>
    </a>
</nav>


<nav class="hidden md:flex bg-white shadow-sm border-b border-brand-border-light py-4 px-6 items-center justify-between sticky top-0 z-20 w-full max-w-md mx-auto">
    <div class="flex items-center space-x-6">
        <a href="{{ url('/') }}" class="font-bold text-brand-emerald-900 text-lg">Cari Kajian</a>
        <a href="{{ url('/kajian') }}" class="text-sm font-medium text-brand-ink-soft hover:text-brand-emerald-700">Jelajah</a>
    </div>
    <div class="flex items-center space-x-6 text-sm font-medium">
        @auth
            <a href="{{ url('/tersimpan') }}" class="text-brand-ink-soft hover:text-brand-emerald-700">Tersimpan</a>
            <a href="{{ url('/kajian-saya') }}" class="text-brand-ink-soft hover:text-brand-emerald-700">Kajian Saya</a>
            <a href="{{ route('profile.edit') }}" class="text-brand-ink-soft hover:text-brand-emerald-700">Profil</a>
        @else
            <a href="{{ route('login') }}" class="text-brand-emerald-700 hover:text-brand-emerald-900">Masuk</a>
            <a href="{{ route('register') }}" class="bg-brand-emerald-900 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-brand-emerald-950 transition">Daftar</a>
        @endauth
    </div>
</nav>

