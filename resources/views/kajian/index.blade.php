@extends('layouts.app')

@section('content')
<div class="p-4 md:p-6 bg-brand-bg-outer min-h-screen">
    
    <!-- Search & Active Filters Form -->
    <form action="{{ url('/kajian') }}" method="GET" class="mb-6">
        <!-- Preserve hidden filters if any -->
        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
        @if(request('date')) <input type="hidden" name="date" value="{{ request('date') }}"> @endif
        @if(request('audience')) <input type="hidden" name="audience" value="{{ request('audience') }}"> @endif
        @if(request('lat')) <input type="hidden" name="lat" value="{{ request('lat') }}"> @endif
        @if(request('lng')) <input type="hidden" name="lng" value="{{ request('lng') }}"> @endif
        @if(request('nearby')) <input type="hidden" name="nearby" value="{{ request('nearby') }}"> @endif
        
        <div class="relative shadow-sm">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg class="w-5 h-5 text-brand-nav-inactive" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="search" name="q" value="{{ request('q') }}" class="block w-full p-4 pl-12 text-sm text-brand-ink bg-white border border-brand-border-light rounded-xl focus:ring-brand-emerald-500 focus:border-brand-emerald-500 transition-colors" placeholder="Cari ustadz, masjid, atau tema...">
            <button type="submit" class="absolute right-2.5 bottom-2.5 bg-brand-emerald-900 hover:bg-brand-emerald-950 text-white focus:ring-4 focus:outline-none focus:ring-brand-emerald-300 font-medium rounded-lg text-sm px-4 py-2 transition">Cari</button>
        </div>
    </form>

    <!-- Categories Filter (Horizontal Scroll) -->
    <div class="mb-4">
        <div class="flex space-x-3 overflow-x-auto pb-2 scrollbar-hide -mx-4 px-4 md:-mx-0 md:px-0">
            <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="flex-none px-4 py-2 rounded-full text-sm font-medium border transition whitespace-nowrap {{ !request('category') ? 'bg-brand-emerald-600 text-white border-brand-emerald-600 shadow-[0_1px_2px_0_rgba(0,0,0,0.05)]' : 'bg-white text-brand-ink-soft border-brand-border-card hover:bg-brand-emerald-50 hover:text-brand-emerald-900 shadow-[0_1px_2px_0_rgba(0,0,0,0.02)]' }}">
                Semua Kategori
            </a>
            @foreach($categories as $cat)
                <a href="{{ request()->fullUrlWithQuery(['category' => $cat->slug]) }}" class="flex-none px-4 py-2 rounded-full text-sm font-medium border transition whitespace-nowrap {{ request('category') === $cat->slug ? 'bg-brand-emerald-600 text-white border-brand-emerald-600 shadow-[0_1px_2px_0_rgba(0,0,0,0.05)]' : 'bg-white text-brand-ink-soft border-brand-border-card hover:bg-brand-emerald-50 hover:text-brand-emerald-900 shadow-[0_1px_2px_0_rgba(0,0,0,0.02)]' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Additional Filters: Date & Audience & Nearby -->
    <div class="flex space-x-2 overflow-x-auto pb-2 mb-6 scrollbar-hide -mx-4 px-4 md:-mx-0 md:px-0">
        <!-- Date -->
        @php $dates = ['today' => 'Hari ini', 'besok' => 'Besok', 'malam-ini' => 'Malam ini']; @endphp
        @foreach($dates as $key => $label)
            <a href="{{ request('date') === $key ? request()->fullUrlWithQuery(['date' => null]) : request()->fullUrlWithQuery(['date' => $key]) }}" class="flex-none px-3 py-1.5 rounded-lg text-xs font-semibold border transition whitespace-nowrap {{ request('date') === $key ? 'bg-brand-emerald-100 text-brand-emerald-900 border-brand-emerald-300' : 'bg-white text-brand-ink-soft border-brand-border-light hover:bg-brand-cream hover:text-brand-emerald-900' }}">
                {{ $label }}
            </a>
        @endforeach

        <!-- Separator -->
        <div class="w-px h-6 bg-brand-border-light mx-1 self-center"></div>

        <!-- Audience -->
        @php $audiences = ['umum' => 'Umum', 'ikhwan' => 'Ikhwan', 'akhwat' => 'Akhwat']; @endphp
        @foreach($audiences as $key => $label)
            <a href="{{ request('audience') === $key ? request()->fullUrlWithQuery(['audience' => null]) : request()->fullUrlWithQuery(['audience' => $key]) }}" class="flex-none px-3 py-1.5 rounded-lg text-xs font-semibold border transition whitespace-nowrap {{ request('audience') === $key ? 'bg-brand-emerald-100 text-brand-emerald-900 border-brand-emerald-300' : 'bg-white text-brand-ink-soft border-brand-border-light hover:bg-brand-cream hover:text-brand-emerald-900' }}">
                {{ $label }}
            </a>
        @endforeach
        
        <!-- Separator -->
        <div class="w-px h-6 bg-brand-border-light mx-1 self-center"></div>
        
        <!-- Nearby -->
        @if(request('lat') && request('lng'))
            <a href="{{ request('nearby') == 1 ? request()->fullUrlWithQuery(['nearby' => null]) : request()->fullUrlWithQuery(['nearby' => 1]) }}" class="flex-none px-3 py-1.5 rounded-lg text-xs font-semibold border transition whitespace-nowrap {{ request('nearby') == 1 ? 'bg-brand-emerald-100 text-brand-emerald-900 border-brand-emerald-300' : 'bg-white text-brand-ink-soft border-brand-border-light hover:bg-brand-cream hover:text-brand-emerald-900' }}">
                Terdekat
            </a>
        @else
            <button type="button" onclick="requestLocation()" class="flex-none px-3 py-1.5 rounded-lg text-xs font-semibold border transition whitespace-nowrap bg-white text-brand-ink-soft border-brand-border-light hover:bg-brand-cream hover:text-brand-emerald-900 focus:outline-none">
                Terdekat
            </button>
        @endif
    </div>

    <!-- Script Geolocation untuk Filter Terdekat -->
    <script>
        function requestLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    let lat = position.coords.latitude;
                    let lng = position.coords.longitude;
                    
                    // Ambil URL saat ini
                    let currentUrl = new URL(window.location.href);
                    
                    // Tambahkan param nearby, lat, dan lng
                    currentUrl.searchParams.set('nearby', '1');
                    currentUrl.searchParams.set('lat', lat);
                    currentUrl.searchParams.set('lng', lng);
                    
                    window.location.href = currentUrl.toString();
                }, function(error) {
                    alert('Gagal mendapatkan lokasi. Pastikan izin lokasi diaktifkan pada browser/device Anda.');
                });
            } else {
                alert('Browser Anda tidak mendukung Geolocation.');
            }
        }
    </script>

    <!-- Applied Filter Indicators (if any active and we want to show a reset button) -->
    @if(request()->except(['lat', 'lng', 'page']))
        <div class="mb-4 flex items-center justify-between bg-brand-cream p-3 rounded-lg border border-brand-border-light shadow-sm">
            <span class="text-xs text-brand-ink font-medium">Filter Aktif</span>
            <a href="{{ url('/kajian' . (request('lat') && request('lng') ? '?lat='.request('lat').'&lng='.request('lng') : '')) }}" class="text-xs text-brand-badge-live font-semibold hover:underline flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Reset Filter
            </a>
        </div>
    @endif

    <!-- Results List -->
    <div class="space-y-4 mb-8">
        @forelse($kajians as $kajian)
            <x-kajian-card :kajian="$kajian" />
        @empty
            <div class="bg-white border border-brand-border-light rounded-xl p-8 text-center shadow-sm">
                <div class="w-16 h-16 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-4 text-brand-emerald-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                </div>
                <h4 class="font-bold text-brand-emerald-950 mb-2">Pencarian Tidak Ditemukan</h4>
                <p class="text-brand-ink-soft text-sm mb-4">Tidak ada kajian yang sesuai dengan kriteria filter Anda saat ini.</p>
                <a href="{{ url('/kajian' . (request('lat') && request('lng') ? '?lat='.request('lat').'&lng='.request('lng') : '')) }}" class="inline-block bg-brand-emerald-900 text-white font-semibold text-sm px-5 py-2.5 rounded-lg hover:bg-brand-emerald-950 transition">
                    Reset Filter
                </a>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="mt-4">
        {{ $kajians->links() }}
    </div>

</div>
@endsection
