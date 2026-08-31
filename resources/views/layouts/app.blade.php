<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Cari Kajian Terdekat') }}</title>

        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-brand-bg-outer text-brand-ink">
        
        
        <div class="min-h-screen max-w-md mx-auto bg-brand-cream relative shadow-sm flex flex-col">
            
            
            <header class="bg-brand-emerald-950 text-white px-4 py-3 flex items-center justify-between sticky top-0 z-10 shadow-sm">
                <div>
                    <h1 class="font-bold text-lg leading-tight tracking-tight">Kajian Terdekat</h1>
                    <div class="flex items-center text-xs text-brand-emerald-300 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 mr-1">
                          <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                        </svg>
                        <span>Mencari lokasi...</span>
                    </div>
                </div>
                <div>
                    
                    <a href="{{ route('profile.edit') }}" class="w-8 h-8 rounded-full bg-brand-emerald-700 flex items-center justify-center border-2 border-brand-emerald-500 overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-white">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                        </svg>
                    </a>
                </div>
            </header>

            
            <main class="flex-1 pb-20"> 
                @yield('content', $slot ?? '')
            </main>

            
            @include('components.bottom-navigation')

        </div>

    <x-toast />
    </body>
</html>


