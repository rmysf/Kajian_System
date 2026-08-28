<x-organizer-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('organizer.kajian.index') }}" class="mr-4 text-gray-400 hover:text-gray-600">
                    <i data-lucide="arrow-left" class="w-6 h-6"></i>
                </a>
                Data Peserta: {{ $kajian->title }}
            </div>
            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-brand-emerald-100 text-brand-emerald-800">
                    Total Peserta: {{ $attendees->count() }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h2 class="text-lg font-bold text-brand-ink">Daftar Jamaah Terdaftar</h2>
                <p class="text-sm text-brand-ink-soft">Daftar ini diisi otomatis dari aplikasi mobile jamaah.</p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-2">
                <!-- Search Box placeholder (Optional for future) -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-4 w-4 text-gray-400"></i>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-brand-emerald-500 focus:border-brand-emerald-500 sm:text-sm transition duration-150 ease-in-out" placeholder="Cari nama jamaah...">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Nama & Email</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Waktu Daftar</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Waktu Check-In</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($attendees as $attendee)
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
                                {{ $attendee->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($attendee->status === 'registered')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Terdaftar
                                    </span>
                                @elseif($attendee->status === 'checked_in')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Hadir (Checked-In)
                                    </span>
                                @elseif($attendee->status === 'cancelled')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Batal
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ ucfirst($attendee->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 text-right">
                                @if($attendee->checked_in_at)
                                    {{ $attendee->checked_in_at->format('d M Y, H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <i data-lucide="users" class="w-12 h-12 text-gray-300 mb-3"></i>
                                    <p class="text-base font-medium text-gray-900">Belum ada peserta</p>
                                    <p class="text-sm">Data pendaftaran dari aplikasi mobile akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-organizer-layout>
