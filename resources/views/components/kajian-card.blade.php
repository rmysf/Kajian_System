@props(['kajian'])

<div class="bg-white rounded-xl border border-brand-border-card p-4 shadow-sm relative">
    @if($kajian->status_label === 'Sedang Berlangsung')
        <span class="absolute top-4 right-4 bg-brand-badge-live text-white text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wide z-10">
            {{ $kajian->status_label }}
        </span>
    @elseif($kajian->status_label !== 'Tidak Diketahui')
        <span class="absolute top-4 right-4 bg-brand-emerald-100 text-brand-emerald-900 border border-brand-emerald-300 text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wide z-10">
            {{ $kajian->status_label }}
        </span>
    @endif
    
    <div class="flex gap-4">
        
        <div class="w-20 h-20 md:w-24 md:h-24 shrink-0 bg-brand-cream rounded-lg overflow-hidden border border-brand-border-light relative mt-6">
            @if($kajian->poster)
                <img src="{{ Storage::url($kajian->poster) }}" alt="{{ $kajian->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-brand-emerald-300 bg-brand-emerald-50">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            @endif
        </div>
        
        
        <div class="flex-1 min-w-0">
            <h4 class="font-bold text-brand-emerald-950 mb-1 truncate pr-16" title="{{ $kajian->title }}">{{ $kajian->title }}</h4>
            <div class="text-brand-emerald-700 text-sm font-medium mb-2 truncate">{{ $kajian->speaker->name ?? 'Ustadz Belum Ditentukan' }}</div>
            
            <div class="flex items-start text-xs text-brand-ink-soft mb-1">
                <svg class="w-3.5 h-3.5 mr-1 flex-none text-brand-nav-inactive" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="truncate">{{ $kajian->mosque->name ?? 'Masjid Belum Ditentukan' }} 
                @if(isset($kajian->distance))
                    <span class="font-semibold text-brand-ink">({{ number_format($kajian->distance, 1) }} KM)</span>
                @endif
                </span>
            </div>
            
            <div class="flex items-start text-xs text-brand-ink-soft">
                <svg class="w-3.5 h-3.5 mr-1 flex-none text-brand-nav-inactive" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ $kajian->start_at->translatedFormat('l, d M Y - H:i') }} WIB</span>
            </div>
        </div>
    </div>
    
    <div class="flex space-x-2 mt-4">
        <a href="{{ url('/kajian/'.$kajian->slug) }}" class="flex-1 bg-brand-emerald-100 text-brand-emerald-900 font-semibold text-sm py-2 rounded-lg text-center transition hover:bg-brand-emerald-300">
            Lihat Detail
        </a>
        <button class="flex-none p-2 border border-brand-border-light rounded-lg text-brand-ink-soft hover:bg-brand-cream hover:text-brand-emerald-900 transition focus:outline-none" title="Simpan">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
        </button>
    </div>
</div>

