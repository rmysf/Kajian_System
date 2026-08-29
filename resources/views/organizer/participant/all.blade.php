<x-organizer-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                Data Peserta
            </div>
        </div>
    </x-slot>

    @php
        $calonPeserta = $attendees->filter(fn($a) => $a->status === 'registered');
        $pesertaHadir = $attendees->filter(fn($a) => in_array($a->status, ['checked_in', 'attended']));
    @endphp

    <div class="max-w-7xl mx-auto">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-brand-ink">Data Peserta</h2>
            <p class="text-sm text-brand-ink-soft mt-1">Kelola calon peserta dan peserta yang telah hadir di kajian Anda.</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden" x-data="{ tab: 'calon' }">
            <div class="border-b border-gray-200 px-6">
                <nav class="-mb-px flex space-x-8">
                    <button @click="tab = 'calon'" 
                            :class="tab === 'calon' ? 'border-brand-emerald-500 text-brand-emerald-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" 
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 focus:outline-none">
                        Calon Peserta
                    </button>
                    <button @click="tab = 'hadir'" 
                            :class="tab === 'hadir' ? 'border-brand-emerald-500 text-brand-emerald-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" 
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 focus:outline-none">
                        Peserta Hadir
                    </button>
                </nav>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">NAMA PESERTA</th>
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">KAJIAN</th>
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">WAKTU DAFTAR</th>
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">STATUS</th>
                        </tr>
                    </thead>
                    
                    <!-- TAB: Calon Peserta -->
                    <tbody class="divide-y divide-gray-200" x-show="tab === 'calon'" x-cloak>
                        @forelse($calonPeserta as $attendee)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-brand-emerald-100 flex items-center justify-center text-brand-emerald-700 font-bold border border-brand-emerald-200">
                                                {{ substr($attendee->user->name ?? '?', 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $attendee->user->name ?? 'User Tidak Diketahui' }}</div>
                                            <div class="text-sm text-gray-500">{{ $attendee->user->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <a href="{{ route('organizer.participant.index', $attendee->kajian->id) }}" class="text-brand-emerald-600 hover:underline">
                                        {{ Str::limit($attendee->kajian->title ?? '-', 40) }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $attendee->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Terdaftar</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <div class="h-16 w-16 rounded-full bg-gray-50 flex items-center justify-center border border-gray-100 mb-4">
                                            <i data-lucide="users" class="w-8 h-8 text-gray-300"></i>
                                        </div>
                                        <p class="text-base font-bold text-gray-900 mb-1">Tidak Ada Calon Peserta</p>
                                        <p class="text-sm text-gray-500 max-w-sm mx-auto">Semua pendaftar di halaman ini sudah hadir atau belum ada pendaftar sama sekali.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    <!-- TAB: Peserta Hadir -->
                    <tbody class="divide-y divide-gray-200" x-show="tab === 'hadir'" x-cloak style="display: none;">
                        @forelse($pesertaHadir as $attendee)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-brand-emerald-100 flex items-center justify-center text-brand-emerald-700 font-bold border border-brand-emerald-200">
                                                {{ substr($attendee->user->name ?? '?', 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $attendee->user->name ?? 'User Tidak Diketahui' }}</div>
                                            <div class="text-sm text-gray-500">{{ $attendee->user->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <a href="{{ route('organizer.participant.index', $attendee->kajian->id) }}" class="text-brand-emerald-600 hover:underline">
                                        {{ Str::limit($attendee->kajian->title ?? '-', 40) }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $attendee->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Hadir</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <div class="h-16 w-16 rounded-full bg-gray-50 flex items-center justify-center border border-gray-100 mb-4">
                                            <i data-lucide="user-check" class="w-8 h-8 text-gray-300"></i>
                                        </div>
                                        <p class="text-base font-bold text-gray-900 mb-1">Tidak Ada Peserta Hadir</p>
                                        <p class="text-sm text-gray-500 max-w-sm mx-auto">Belum ada jamaah yang melakukan check-in kehadiran di kajian Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-organizer-layout>
