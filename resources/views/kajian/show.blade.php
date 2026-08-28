<x-app-layout>
    <x-slot name="header">
        Detail Kajian
    </x-slot>

    <div class="pb-24">
        <!-- Poster -->
        <div class="w-full aspect-video bg-gray-200 relative">
            @if($kajian->poster)
                <img src="{{ Storage::url($kajian->poster) }}" alt="{{ $kajian->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center bg-brand-emerald-900 text-white">
                    <i data-lucide="book-open" class="w-16 h-16 mb-4 opacity-50"></i>
                    <span class="text-lg font-bold opacity-75">Kajian Islami</span>
                </div>
            @endif
            
            <!-- Category Badge -->
            <div class="absolute top-4 left-4">
                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-brand-emerald-900 text-xs font-bold rounded-full shadow-sm">
                    {{ $kajian->category->name }}
                </span>
            </div>
        </div>

        <div class="px-4 py-6">
            <!-- Header Info -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-brand-ink leading-tight mb-2">{{ $kajian->title }}</h1>
                <div class="flex items-center text-brand-emerald-700 font-medium">
                    <div class="w-8 h-8 rounded-full overflow-hidden mr-3 border border-brand-emerald-200 bg-brand-emerald-50">
                        @if($kajian->speaker->photo)
                            <img src="{{ Storage::url($kajian->speaker->photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xs font-bold">
                                {{ substr($kajian->speaker->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <span>{{ $kajian->speaker->name }}</span>
                </div>
            </div>

            <!-- Status Alerts (For Admin) -->
            @if(Auth::check() && Auth::user()->role === 'admin')
                @if(!$kajian->is_verified && $kajian->status !== 'cancelled')
                    <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                        <div class="flex items-start">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-yellow-600 mt-0.5 mr-3 flex-shrink-0"></i>
                            <div class="w-full">
                                <h4 class="text-sm font-bold text-yellow-800">Menunggu Moderasi</h4>
                                <p class="text-sm text-yellow-700 mt-1">Kajian ini belum dipublikasikan ke Jamaah. Silakan tinjau dan berikan keputusan.</p>
                                <div class="mt-4 flex gap-3">
                                    <form action="{{ route('admin.kajian.verify', $kajian->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 bg-brand-emerald-900 text-white text-sm font-bold rounded-lg hover:bg-brand-emerald-950 transition shadow-sm">
                                            Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.kajian.reject', $kajian->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 bg-red-100 text-red-700 border border-red-200 text-sm font-bold rounded-lg hover:bg-red-200 transition">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($kajian->status === 'cancelled')
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center text-red-700 text-sm">
                        <i data-lucide="x-circle" class="w-5 h-5 mr-2"></i> Kajian ini telah ditolak / dibatalkan.
                    </div>
                @endif
            @endif

            <!-- Detail Grid -->
            <div class="grid grid-cols-1 gap-4 mb-8">
                <!-- Waktu -->
                <div class="flex items-start p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <i data-lucide="calendar-clock" class="w-6 h-6 text-brand-emerald-700 mt-1 mr-3 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-brand-ink-soft uppercase font-bold tracking-wider mb-1">Waktu</p>
                        <p class="text-sm font-semibold text-brand-ink">{{ $kajian->start_at->translatedFormat('l, d F Y') }}</p>
                        <p class="text-sm text-brand-ink-soft mt-0.5">{{ $kajian->start_at->format('H:i') }} - {{ $kajian->end_at->format('H:i') }} WIB</p>
                    </div>
                </div>

                <!-- Lokasi -->
                <div class="flex items-start p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <i data-lucide="map-pin" class="w-6 h-6 text-brand-emerald-700 mt-1 mr-3 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-brand-ink-soft uppercase font-bold tracking-wider mb-1">Lokasi</p>
                        <p class="text-sm font-semibold text-brand-ink">{{ $kajian->mosque->name }}</p>
                        <p class="text-sm text-brand-ink-soft mt-0.5">{{ $kajian->address }}</p>
                    </div>
                </div>

                <!-- Peserta -->
                <div class="flex items-start p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <i data-lucide="users" class="w-6 h-6 text-brand-emerald-700 mt-1 mr-3 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-brand-ink-soft uppercase font-bold tracking-wider mb-1">Jamaah</p>
                        <p class="text-sm font-semibold text-brand-ink">
                            @if($kajian->audience === 'umum') Umum (Ikhwan & Akhwat)
                            @elseif($kajian->audience === 'ikhwan') Khusus Ikhwan
                            @elseif($kajian->audience === 'akhwat') Khusus Akhwat
                            @endif
                        </p>
                        @if($kajian->is_family_friendly)
                            <span class="inline-block mt-1 px-2 py-0.5 bg-blue-100 text-blue-800 text-[10px] font-bold rounded">Ramah Anak/Keluarga</span>
                        @endif
                    </div>
                </div>

                <!-- Biaya -->
                <div class="flex items-start p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <i data-lucide="wallet" class="w-6 h-6 text-brand-emerald-700 mt-1 mr-3 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-brand-ink-soft uppercase font-bold tracking-wider mb-1">Biaya</p>
                        @if($kajian->is_free)
                            <p class="text-sm font-bold text-green-600">Gratis (Free)</p>
                        @else
                            <p class="text-sm font-semibold text-brand-ink">Rp {{ number_format($kajian->price, 0, ',', '.') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-brand-ink mb-3 border-b border-gray-100 pb-2">Deskripsi Kajian</h3>
                <div class="prose prose-sm max-w-none text-brand-ink-soft">
                    {!! nl2br(e($kajian->description ?: 'Tidak ada deskripsi tambahan untuk kajian ini.')) !!}
                </div>
            </div>

            <!-- Penyelenggara Info -->
            <div class="bg-brand-cream/30 border border-brand-border-light rounded-xl p-4 flex items-center mb-8">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4 border border-brand-border-light shadow-sm flex-shrink-0">
                    <i data-lucide="shield" class="w-6 h-6 text-brand-emerald-700"></i>
                </div>
                <div>
                    <p class="text-xs text-brand-ink-soft">Penyelenggara</p>
                    <p class="text-sm font-bold text-brand-ink">{{ $kajian->organizer->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Bar -->
    <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white border-t border-gray-200 p-4 shadow-[0_-10px_40px_rgba(0,0,0,0.05)] z-40">
        <div class="flex gap-2">
            <button class="flex items-center justify-center w-12 h-12 bg-gray-50 border border-gray-200 text-gray-500 hover:text-red-500 hover:bg-red-50 hover:border-red-200 rounded-xl transition flex-shrink-0">
                <i data-lucide="heart" class="w-6 h-6"></i>
            </button>
            <a href="https://maps.google.com/?q={{ $kajian->latitude }},{{ $kajian->longitude }}" target="_blank" class="flex-[1] flex items-center justify-center bg-white border-2 border-brand-emerald-900 text-brand-emerald-900 font-bold rounded-xl hover:bg-brand-emerald-50 transition text-sm">
                <i data-lucide="navigation" class="w-4 h-4 mr-1"></i> Rute
            </a>
            <button class="flex-[1.5] flex items-center justify-center bg-brand-emerald-900 text-white font-bold rounded-xl hover:bg-brand-emerald-950 transition shadow-sm text-sm">
                Saya Mau Hadir
            </button>
        </div>
    </div>

</x-app-layout>
