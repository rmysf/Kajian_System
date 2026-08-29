<x-organizer-layout>
    <x-slot name="header">
        Data Peserta
    </x-slot>

    <!-- Header Deskripsi -->
    <div class="mb-6">
        <p class="text-brand-ink-soft">Kelola calon peserta dan peserta yang telah hadir di kajian Anda.</p>
    </div>

    <!-- Tabel Data Peserta -->
    <div class="bg-white border border-brand-border-card rounded-xl shadow-sm" x-data="{ tab: 'calon' }">

        <!-- Custom Tabs -->
        <div class="border-b border-brand-border-card px-6">
            <nav class="-mb-px flex space-x-8">
                <button @click="tab = 'calon'" 
                        :class="tab === 'calon' ? 'border-brand-emerald-900 text-brand-emerald-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center transition-colors outline-none focus:outline-none">
                    Calon Peserta
                </button>
                <button @click="tab = 'hadir'" 
                        :class="tab === 'hadir' ? 'border-brand-emerald-900 text-brand-emerald-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center transition-colors outline-none focus:outline-none">
                    Peserta Hadir
                </button>
            </nav>
        </div>

        <!-- Tab Content: Calon Peserta -->
        <div x-show="tab === 'calon'" class="overflow-x-auto" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Nama Peserta</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Kajian</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Waktu Daftar</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $hasCalon = false; @endphp
                    @foreach($attendees as $attendee)
                        @if(!$attendee->checked_in_at)
                            @php $hasCalon = true; @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-brand-ink">{{ $attendee->user->name ?? 'User Tidak Dikenal' }}</div>
                                    <div class="text-sm text-gray-500">{{ $attendee->user->email ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-brand-ink">{{ Str::limit($attendee->kajian->title, 40) }}</div>
                                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($attendee->kajian->start_at)->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-brand-ink">{{ $attendee->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-brand-ink-soft">{{ $attendee->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i> Menunggu Hadir
                                    </span>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    
                    @if(!$hasCalon)
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center bg-gray-50/30">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm border border-gray-100">
                                        <i data-lucide="users" class="w-8 h-8 text-gray-400"></i>
                                    </div>
                                    <h3 class="text-base font-semibold text-brand-ink mb-1">Tidak Ada Calon Peserta</h3>
                                    <p class="text-sm text-brand-ink-soft max-w-sm">Semua pendaftar di halaman ini sudah hadir atau belum ada pendaftar sama sekali.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Tab Content: Peserta Hadir -->
        <div x-show="tab === 'hadir'" style="display: none;" class="overflow-x-auto" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Nama Peserta</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Kajian</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Waktu Daftar</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Waktu Hadir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $hasHadir = false; @endphp
                    @foreach($attendees as $attendee)
                        @if($attendee->checked_in_at)
                            @php $hasHadir = true; @endphp
                            <tr class="hover:bg-brand-emerald-50/30 transition">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-brand-ink flex items-center">
                                        {{ $attendee->user->name ?? 'User Tidak Dikenal' }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $attendee->user->email ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-brand-ink">{{ Str::limit($attendee->kajian->title, 40) }}</div>
                                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($attendee->kajian->start_at)->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-brand-ink">{{ $attendee->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-brand-ink-soft">{{ $attendee->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-emerald-100 text-brand-emerald-950 border border-brand-emerald-200 mb-1">
                                        <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i> Hadir
                                    </span>
                                    <div class="text-xs font-medium text-brand-emerald-800">{{ \Carbon\Carbon::parse($attendee->checked_in_at)->format('d M, H:i') }} WIB</div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    
                    @if(!$hasHadir)
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center bg-gray-50/30">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm border border-gray-100">
                                        <i data-lucide="check-circle" class="w-8 h-8 text-gray-400"></i>
                                    </div>
                                    <h3 class="text-base font-semibold text-brand-ink mb-1">Belum Ada Peserta Hadir</h3>
                                    <p class="text-sm text-brand-ink-soft max-w-sm">Jamaah di halaman ini belum ada yang melakukan check-in kehadiran.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($attendees->hasPages())
            <div class="p-4 border-t border-gray-200">
                {{ $attendees->links() }}
            </div>
        @endif
    </div>
</x-organizer-layout>
