@extends('layouts.app')

@section('content')
<div class="p-4 md:p-6">
    
    <div class="mb-6 mt-2">
        @if(!$lat || !$lng)
            <div class="bg-brand-emerald-50 border border-brand-emerald-100 rounded-xl p-4 flex items-start space-x-3 mb-6">
                <div class="text-brand-emerald-600 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-bold text-brand-emerald-950 mb-1">Temukan Kajian Terdekat</h3>
                    <p class="text-xs text-brand-ink-soft mb-3">Aktifkan lokasi untuk melihat kajian yang ada di sekitar Anda.</p>
                    <button onclick="requestLocation()" class="text-xs font-semibold bg-brand-emerald-900 text-white px-3 py-1.5 rounded-lg hover:bg-brand-emerald-950 transition">
                        Aktifkan Lokasi
                    </button>
                </div>
            </div>
            
            
            <script>
                function requestLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            let lat = position.coords.latitude;
                            let lng = position.coords.longitude;
                            window.location.href = `/?lat=${lat}&lng=${lng}`;
                        }, function(error) {
                            alert('Gagal mendapatkan lokasi. Pastikan izin lokasi diaktifkan pada browser/device Anda.');
                        });
                    } else {
                        alert('Browser Anda tidak mendukung Geolocation.');
                    }
                }
            </script>
        @else
            <h2 class="text-2xl md:text-3xl font-bold text-brand-emerald-950 tracking-tight">Kajian di sekitar,<br/>lebih dekat dengan ilmu.</h2>
            <p class="text-brand-ink-soft text-sm mt-3 leading-relaxed">Menampilkan kajian dalam radius terdekat dari lokasi Anda.</p>
        @endif
    </div>

    
    <form action="{{ url('/kajian') }}" method="GET" class="relative mb-8 shadow-sm">
        @if($lat) <input type="hidden" name="lat" value="{{ $lat }}"> @endif
        @if($lng) <input type="hidden" name="lng" value="{{ $lng }}"> @endif
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
            <svg class="w-5 h-5 text-brand-nav-inactive" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input type="search" name="q" class="block w-full p-4 pl-12 text-sm text-brand-ink bg-white border border-brand-border-light rounded-xl focus:ring-brand-emerald-500 focus:border-brand-emerald-500 transition-colors" placeholder="Cari ustadz, masjid, atau tema..." required>
        <button type="submit" class="absolute right-2.5 bottom-2.5 bg-brand-emerald-900 hover:bg-brand-emerald-950 text-white focus:ring-4 focus:outline-none focus:ring-brand-emerald-300 font-medium rounded-lg text-sm px-4 py-2 transition">Cari</button>
    </form>

    
    @if($categories->count() > 0)
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-brand-emerald-950">Kategori Pilihan</h3>
            <a href="{{ url('/kajian') }}" class="text-xs font-semibold text-brand-emerald-600 hover:text-brand-emerald-700 transition">Lihat Semua</a>
        </div>
        <div class="flex space-x-3 overflow-x-auto pb-2 scrollbar-hide -mx-4 px-4 md:-mx-0 md:px-0">
            @foreach($categories as $category)
                <x-category-chip :category="$category" />
            @endforeach
        </div>
    </div>
    @endif

    
    <div>
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-brand-emerald-950">{{ ($lat && $lng) ? 'Kajian Terdekat' : 'Kajian Akan Datang' }}</h3>
        </div>
        
        <div class="space-y-4">
            @forelse($kajians as $kajian)
                <x-kajian-card :kajian="$kajian" />
            @empty
                <div class="bg-white border border-brand-border-light rounded-xl p-8 text-center shadow-sm">
                    <div class="w-16 h-16 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-4 text-brand-emerald-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h4 class="font-bold text-brand-emerald-950 mb-2">Belum Ada Kajian</h4>
                    <p class="text-brand-ink-soft text-sm">
                        @if($lat && $lng)
                            Tidak ditemukan kajian di sekitar lokasi Anda saat ini. Coba perbesar radius atau cari di area lain.
                        @else
                            Saat ini belum ada jadwal kajian yang akan datang.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

