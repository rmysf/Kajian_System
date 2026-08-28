<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login - KajianHub</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body class="font-sans antialiased text-brand-ink" style="background-color: #17211c;">
        <div class="min-h-screen flex items-center justify-center p-4 sm:p-8">
            <div class="w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row h-auto md:h-[600px]">
                
                <!-- Left Image Area -->
                <div class="w-full md:w-1/2 h-64 md:h-full relative hidden md:block">
                    <!-- Menggunakan gambar placeholder masjid yang cantik dari Unsplash -->
                    <img src="https://images.unsplash.com/photo-1564769625905-50e93615e769?q=80&w=1470&auto=format&fit=crop" alt="Mosque" class="absolute inset-0 w-full h-full object-cover">
                </div>

                <!-- Right Form Area -->
                <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center bg-white relative">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="mb-8">
                        <div class="font-bold text-xl text-brand-ink tracking-tight flex items-center mb-6">
                            KajianHub
                        </div>
                        <h1 class="text-3xl font-bold text-brand-ink mb-2 tracking-tight">Masuk ke Akun</h1>
                        <p class="text-sm text-gray-500">Silakan masuk untuk menyimpan jadwal dan tiket kajian Anda.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@kajianhub.com" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-gray-50 text-brand-ink focus:border-brand-emerald-900 focus:ring-1 focus:ring-brand-emerald-900 transition shadow-sm outline-none">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                                @if (Route::has('password.request'))
                                    <a class="text-xs text-brand-emerald-900 hover:text-brand-emerald-950 font-medium" href="{{ route('password.request') }}">
                                        Lupa sandi?
                                    </a>
                                @endif
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-gray-50 text-brand-ink focus:border-brand-emerald-900 focus:ring-1 focus:ring-brand-emerald-900 transition shadow-sm outline-none">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-brand-emerald-900 bg-white border-gray-300 rounded focus:ring-brand-emerald-900 focus:ring-offset-0">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                                Ingat saya
                            </label>
                        </div>

                        <div class="pt-2">
                            <!-- Tombol Google -->
                            <button type="button" class="w-full flex items-center justify-center px-4 py-2.5 border border-gray-300 shadow-sm rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                </svg>
                                Lanjutkan dengan Google
                            </button>
                        </div>
                        
                        <div class="relative flex items-center py-2">
                            <div class="flex-grow border-t border-gray-200"></div>
                            <span class="flex-shrink-0 mx-4 text-gray-400 text-xs">atau</span>
                            <div class="flex-grow border-t border-gray-200"></div>
                        </div>

                        <!-- Login Button -->
                        <div>
                            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#0f9f6e] hover:bg-[#087957] transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0f9f6e]">
                                Masuk dengan Email
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center text-sm text-gray-600">
                        Belum punya akun? <a href="{{ route('register') }}" class="font-medium text-brand-emerald-900 hover:text-brand-emerald-950 transition">Daftar sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            lucide.createIcons();
        </script>
    </body>
</html>
