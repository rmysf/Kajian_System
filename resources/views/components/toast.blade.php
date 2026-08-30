@if(session('success') || session('error'))
    @php
        $type = session('success') ? 'success' : 'error';
        $message = session('success') ? session('success') : session('error');
    @endphp
    
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed top-5 right-5 left-5 sm:left-auto sm:max-w-sm z-[9999] bg-white shadow-xl rounded-xl border border-gray-100 overflow-hidden pointer-events-auto"
    >
        <div class="p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                @if($type === 'success')
                    <div class="p-2 bg-brand-emerald-100 text-brand-emerald-950 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-brand-emerald-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                @else
                    <div class="p-2 bg-red-100 text-brand-danger rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="text-sm font-bold text-brand-ink">
                        {{ $type === 'success' ? 'Sukses' : 'Gagal' }}
                    </p>
                    <p class="text-xs text-brand-ink-soft mt-0.5">{{ $message }}</p>
                </div>
            </div>
            <button @click="show = false" class="p-1 rounded-lg text-gray-400 hover:bg-gray-100 hover:text-brand-ink transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endif
