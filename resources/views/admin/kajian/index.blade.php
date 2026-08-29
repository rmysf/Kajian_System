<x-admin-layout>
    <x-slot name="header">
        Moderasi Kajian
    </x-slot>

    <div x-data="{
        modalOpen: false,
        activeKajian: null,
        
        openModal(kajian) {
            this.activeKajian = kajian;
            this.modalOpen = true;
        },
        closeModal() {
            this.modalOpen = false;
            setTimeout(() => { this.activeKajian = null; }, 300);
        }
    }">
        <div class="bg-white border border-brand-border-card rounded-xl mb-6">
            <div class="p-6 border-b border-brand-border-card">
                <h2 class="text-lg font-bold text-brand-ink">Moderasi Kajian Masuk</h2>
                <p class="text-sm text-brand-ink-soft mt-1">Tinjau dan verifikasi kajian baru yang dikirimkan oleh penyelenggara.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-brand-border-card">
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Judul & Penyelenggara</th>
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Status Verifikasi</th>
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border-card">
                        @forelse($kajians as $kajian)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="font-medium text-brand-ink">{{ $kajian->title }}</div>
                                <div class="text-sm text-brand-ink-soft mt-1">Oleh: {{ $kajian->organizer->name ?? 'Penyelenggara Tidak Diketahui' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-brand-ink">{{ $kajian->start_at ? $kajian->start_at->format('d M Y') : '-' }}</div>
                                <div class="text-xs text-brand-ink-soft mt-1">
                                    {{ $kajian->start_at ? $kajian->start_at->format('H:i') : '-' }} 
                                    - 
                                    {{ $kajian->end_at ? $kajian->end_at->format('H:i') : '-' }} WIB
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($kajian->is_verified)
                                    <x-admin.badge variant="success">Disetujui</x-admin.badge>
                                @elseif($kajian->status === 'cancelled')
                                    <x-admin.badge variant="danger">Ditolak</x-admin.badge>
                                @else
                                    <x-admin.badge variant="warning">Menunggu</x-admin.badge>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <x-admin.button variant="ghost" size="sm" @click="openModal({{ json_encode([
                                    'id' => $kajian->id,
                                    'title' => $kajian->title,
                                    'organizer' => $kajian->organizer->name ?? '-',
                                    'speaker' => $kajian->speaker->name ?? '-',
                                    'mosque' => $kajian->mosque->name ?? '-',
                                    'address' => $kajian->address ?? '-',
                                    'date' => $kajian->start_at ? $kajian->start_at->translatedFormat('d F Y') : '-',
                                    'time' => $kajian->start_at ? $kajian->start_at->format('H:i') . ' - ' . $kajian->end_at->format('H:i') . ' WIB' : '-',
                                    'poster' => $kajian->poster ? Storage::url($kajian->poster) : null,
                                    'category' => $kajian->category->name ?? '-',
                                    'is_verified' => $kajian->is_verified,
                                    'status' => $kajian->status,
                                    'verify_url' => route('admin.kajian.verify', $kajian->id),
                                    'reject_url' => route('admin.kajian.reject', $kajian->id)
                                ]) }})">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1.5"></i> Tinjau
                                </x-admin.button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-brand-ink-soft">
                                Tidak ada kajian yang perlu dimoderasi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Detail Modal -->
        <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>

            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div x-show="modalOpen" x-transition.scale.origin.center class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 w-full max-w-3xl border border-brand-border-card">
                    
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between border-b border-brand-border-card px-6 py-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-xl font-bold text-brand-ink" id="modal-title">Detail Kajian</h3>
                            
                            <template x-if="activeKajian && !activeKajian.is_verified && activeKajian.status !== 'cancelled'">
                                <x-admin.badge variant="warning">Menunggu Verifikasi</x-admin.badge>
                            </template>
                            <template x-if="activeKajian && activeKajian.is_verified">
                                <x-admin.badge variant="success">Disetujui</x-admin.badge>
                            </template>
                            <template x-if="activeKajian && activeKajian.status === 'cancelled'">
                                <x-admin.badge variant="danger">Ditolak</x-admin.badge>
                            </template>
                        </div>
                        <button type="button" @click="closeModal()" class="rounded-full p-2 text-brand-ink-soft hover:bg-gray-100 transition">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 py-5 bg-gray-50/50">
                        <p class="text-sm text-brand-ink-soft mb-6">Tinjau informasi dan poster kajian sebelum memberikan persetujuan.</p>

                        <div class="bg-white border border-brand-border-card rounded-xl p-5 mb-6 flex flex-col md:flex-row gap-6">
                            <!-- Poster -->
                            <div class="w-full md:w-1/3 aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden border border-brand-border-card flex-shrink-0 relative flex items-center justify-center">
                                <template x-if="activeKajian && activeKajian.poster">
                                    <img :src="activeKajian.poster" class="w-full h-full object-cover">
                                </template>
                                <template x-if="activeKajian && !activeKajian.poster">
                                    <div class="text-center text-brand-nav-inactive">
                                        <i data-lucide="image" class="w-12 h-12 mx-auto mb-2 opacity-50"></i>
                                        <span class="text-xs font-medium">Tidak ada poster</span>
                                    </div>
                                </template>
                            </div>
                            
                            <!-- Info Grid -->
                            <div class="flex-1 space-y-4">
                                <div>
                                    <p class="text-xs text-brand-ink-soft font-semibold uppercase tracking-wider mb-1">Judul Kajian</p>
                                    <p class="text-base font-bold text-brand-ink" x-text="activeKajian ? activeKajian.title : '-'"></p>
                                    <span class="inline-block mt-1 px-2 py-0.5 bg-brand-emerald-100 text-brand-emerald-900 text-xs font-semibold rounded" x-text="activeKajian ? activeKajian.category : '-'"></span>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs text-brand-ink-soft font-semibold uppercase tracking-wider mb-1">Pemateri</p>
                                        <p class="text-sm font-medium text-brand-ink" x-text="activeKajian ? activeKajian.speaker : '-'"></p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-brand-ink-soft font-semibold uppercase tracking-wider mb-1">Penyelenggara</p>
                                        <p class="text-sm font-medium text-brand-ink" x-text="activeKajian ? activeKajian.organizer : '-'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Waktu & Lokasi -->
                        <div class="flex gap-4">
                            <div class="flex-1 bg-white border border-brand-border-card rounded-xl p-4 flex items-start gap-3">
                                <div class="bg-brand-emerald-100 text-brand-emerald-900 p-2 rounded-lg"><i data-lucide="calendar" class="w-5 h-5"></i></div>
                                <div>
                                    <p class="text-xs text-brand-ink-soft font-semibold uppercase">Waktu</p>
                                    <p class="text-sm font-semibold text-brand-ink mt-1" x-text="activeKajian ? activeKajian.date : '-'"></p>
                                    <p class="text-xs text-brand-ink-soft mt-0.5" x-text="activeKajian ? activeKajian.time : '-'"></p>
                                </div>
                            </div>
                            <div class="flex-[1.5] bg-white border border-brand-border-card rounded-xl p-4 flex items-start gap-3">
                                <div class="bg-brand-emerald-100 text-brand-emerald-900 p-2 rounded-lg"><i data-lucide="building-2" class="w-5 h-5"></i></div>
                                <div>
                                    <p class="text-xs text-brand-ink-soft font-semibold uppercase">Lokasi / Masjid</p>
                                    <p class="text-sm font-semibold text-brand-ink mt-1" x-text="activeKajian ? activeKajian.mosque : '-'"></p>
                                    <p class="text-xs text-brand-ink-soft mt-0.5" x-text="activeKajian ? activeKajian.address : '-'"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <template x-if="activeKajian && !activeKajian.is_verified && activeKajian.status !== 'cancelled'">
                        <div class="bg-white px-6 py-4 border-t border-brand-border-card flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="w-full sm:w-1/2">
                                <p class="text-xs font-semibold text-brand-ink mb-1">Alasan (jika ditolak)</p>
                                <input type="text" placeholder="Contoh: Poster kurang jelas..." class="w-full rounded-lg border-brand-border-light shadow-sm focus:border-brand-emerald-900 focus:ring-brand-emerald-900 text-sm">
                            </div>
                            <div class="flex gap-3 w-full sm:w-auto">
                                <form :action="activeKajian.reject_url" method="POST" class="flex-1 sm:flex-none">
                                    @csrf
                                    <x-admin.button variant="danger" type="submit" class="w-full sm:w-auto">
                                        Tolak
                                    </x-admin.button>
                                </form>
                                <form :action="activeKajian.verify_url" method="POST" class="flex-1 sm:flex-none">
                                    @csrf
                                    <x-admin.button variant="primary" type="submit" class="w-full sm:w-auto">
                                        Verifikasi
                                    </x-admin.button>
                                </form>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
