@extends('layouts.app')

@section('content')
<div class="p-4 md:p-6 bg-brand-bg-outer min-h-screen">
    
    
    <form action="{{ url('/kajian') }}" method="GET" class="mb-6" id="filterForm">
        
        <input type="hidden" name="category" id="filter_category" value="{{ request('category') }}">
        <input type="hidden" name="date" id="filter_date" value="{{ request('date') }}">
        <input type="hidden" name="audience" id="filter_audience" value="{{ request('audience') }}">
        <input type="hidden" name="lat" id="filter_lat" value="{{ request('lat') }}">
        <input type="hidden" name="lng" id="filter_lng" value="{{ request('lng') }}">
        <input type="hidden" name="nearby" id="filter_nearby" value="{{ request('nearby') }}">
        
        <div class="relative shadow-sm">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg class="w-5 h-5 text-brand-nav-inactive" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="search" name="q" id="filter_q" value="{{ request('q') }}" class="block w-full p-4 pl-12 text-sm text-brand-ink bg-white border border-brand-border-light rounded-xl focus:ring-brand-emerald-500 focus:border-brand-emerald-500 transition-colors" placeholder="Cari ustadz, masjid, atau tema...">
            <button type="submit" class="absolute right-2.5 bottom-2.5 bg-brand-emerald-900 hover:bg-brand-emerald-950 text-white focus:ring-4 focus:outline-none focus:ring-brand-emerald-300 font-medium rounded-lg text-sm px-4 py-2 transition">Cari</button>
        </div>
    </form>

    
    <div class="mb-4">
        <div class="flex space-x-3 overflow-x-auto pb-2 scrollbar-hide -mx-4 px-4 md:-mx-0 md:px-0">
            <button type="button" onclick="setFilter('category', '')" class="flex-none px-4 py-2 rounded-full text-sm font-medium border transition whitespace-nowrap {{ !request('category') ? 'bg-brand-emerald-600 text-white border-brand-emerald-600 shadow-[0_1px_2px_0_rgba(0,0,0,0.05)]' : 'bg-white text-brand-ink-soft border-brand-border-card hover:bg-brand-emerald-50 hover:text-brand-emerald-900 shadow-[0_1px_2px_0_rgba(0,0,0,0.02)]' }}">
                Semua Kategori
            </button>
            @foreach($categories as $cat)
                <button type="button" onclick="setFilter('category', '{{ $cat->slug }}')" class="flex-none px-4 py-2 rounded-full text-sm font-medium border transition whitespace-nowrap {{ request('category') === $cat->slug ? 'bg-brand-emerald-600 text-white border-brand-emerald-600 shadow-[0_1px_2px_0_rgba(0,0,0,0.05)]' : 'bg-white text-brand-ink-soft border-brand-border-card hover:bg-brand-emerald-50 hover:text-brand-emerald-900 shadow-[0_1px_2px_0_rgba(0,0,0,0.02)]' }}">
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>
    </div>

    
    <div class="flex space-x-2 overflow-x-auto pb-2 mb-6 scrollbar-hide -mx-4 px-4 md:-mx-0 md:px-0">
        
        @php $dates = ['today' => 'Hari ini', 'besok' => 'Besok', 'malam-ini' => 'Malam ini']; @endphp
        @foreach($dates as $key => $label)
            <button type="button" onclick="toggleFilter('date', '{{ $key }}')" class="flex-none px-3 py-1.5 rounded-lg text-xs font-semibold border transition whitespace-nowrap {{ request('date') === $key ? 'bg-brand-emerald-100 text-brand-emerald-900 border-brand-emerald-300' : 'bg-white text-brand-ink-soft border-brand-border-light hover:bg-brand-cream hover:text-brand-emerald-900' }}">
                {{ $label }}
            </button>
        @endforeach

        
        <div class="w-px h-6 bg-brand-border-light mx-1 self-center"></div>

        
        @php $audiences = ['umum' => 'Umum', 'ikhwan' => 'Ikhwan', 'akhwat' => 'Akhwat']; @endphp
        @foreach($audiences as $key => $label)
            <button type="button" onclick="toggleFilter('audience', '{{ $key }}')" class="flex-none px-3 py-1.5 rounded-lg text-xs font-semibold border transition whitespace-nowrap {{ request('audience') === $key ? 'bg-brand-emerald-100 text-brand-emerald-900 border-brand-emerald-300' : 'bg-white text-brand-ink-soft border-brand-border-light hover:bg-brand-cream hover:text-brand-emerald-900' }}">
                {{ $label }}
            </button>
        @endforeach
        
        
        <div class="w-px h-6 bg-brand-border-light mx-1 self-center"></div>
        
        
        @if(request('lat') && request('lng'))
            <button type="button" onclick="toggleFilter('nearby', '1')" class="flex-none px-3 py-1.5 rounded-lg text-xs font-semibold border transition whitespace-nowrap {{ request('nearby') == 1 ? 'bg-brand-emerald-100 text-brand-emerald-900 border-brand-emerald-300' : 'bg-white text-brand-ink-soft border-brand-border-light hover:bg-brand-cream hover:text-brand-emerald-900' }}">
                Terdekat
            </button>
        @else
            <button type="button" onclick="requestLocation()" class="flex-none px-3 py-1.5 rounded-lg text-xs font-semibold border transition whitespace-nowrap bg-white text-brand-ink-soft border-brand-border-light hover:bg-brand-cream hover:text-brand-emerald-900 focus:outline-none">
                Terdekat
            </button>
        @endif
    </div>

    
    <script>
        function setFilter(key, value) {
            document.getElementById('filter_' + key).value = value;
            document.getElementById('filterForm').submit();
        }

        function toggleFilter(key, value) {
            let input = document.getElementById('filter_' + key);
            if (input.value === value) {
                input.value = '';
            } else {
                input.value = value;
            }
            document.getElementById('filterForm').submit();
        }

        function requestLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('filter_lat').value = position.coords.latitude;
                    document.getElementById('filter_lng').value = position.coords.longitude;
                    document.getElementById('filter_nearby').value = '1';
                    document.getElementById('filterForm').submit();
                }, function(error) {
                    alert('Gagal mendapatkan lokasi. Pastikan izin lokasi diaktifkan pada browser/device Anda.');
                });
            } else {
                alert('Browser Anda tidak mendukung Geolocation.');
            }
        }
    </script>

    
    @if(request()->except(['lat', 'lng', 'page']))
        <div class="mb-4 flex flex-col bg-brand-cream p-3 rounded-lg border border-brand-border-light shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-brand-ink font-medium">Filter Aktif</span>
                <a href="{{ url('/kajian' . (request('lat') && request('lng') ? '?lat='.request('lat').'&lng='.request('lng') : '')) }}" class="text-xs text-brand-danger font-semibold hover:underline flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Reset Filter
                </a>
            </div>
            <div class="flex flex-wrap gap-2">
                @if(request('q'))
                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-white border border-brand-border-light text-xs font-medium text-brand-ink">
                        Pencarian: {{ request('q') }}
                        <button type="button" onclick="setFilter('q', '')" class="ml-1 text-brand-ink-soft hover:text-brand-danger focus:outline-none">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </span>
                @endif
                @if(request('category'))
                    @php $activeCategory = $categories->firstWhere('slug', request('category')); @endphp
                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-white border border-brand-border-light text-xs font-medium text-brand-ink">
                        Kategori: {{ $activeCategory ? $activeCategory->name : request('category') }}
                        <button type="button" onclick="setFilter('category', '')" class="ml-1 text-brand-ink-soft hover:text-brand-danger focus:outline-none">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </span>
                @endif
                @if(request('date'))
                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-white border border-brand-border-light text-xs font-medium text-brand-ink">
                        Waktu: {{ $dates[request('date')] ?? request('date') }}
                        <button type="button" onclick="setFilter('date', '')" class="ml-1 text-brand-ink-soft hover:text-brand-danger focus:outline-none">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </span>
                @endif
                @if(request('audience'))
                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-white border border-brand-border-light text-xs font-medium text-brand-ink">
                        Jamaah: {{ $audiences[request('audience')] ?? request('audience') }}
                        <button type="button" onclick="setFilter('audience', '')" class="ml-1 text-brand-ink-soft hover:text-brand-danger focus:outline-none">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </span>
                @endif
                @if(request('nearby') == 1)
                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-white border border-brand-border-light text-xs font-medium text-brand-ink">
                        Terdekat
                        <button type="button" onclick="setFilter('nearby', '')" class="ml-1 text-brand-ink-soft hover:text-brand-danger focus:outline-none">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </span>
                @endif
            </div>
        </div>
    @endif

    
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
    
    
    <div class="mt-4">
        {{ $kajians->links() }}
    </div>

</div>
@endsection

