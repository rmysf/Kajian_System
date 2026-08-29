<x-organizer-layout>
    <x-slot name="header">
        Kelola Kajian
    </x-slot>

    <div x-data="{ deleteModalOpen: false, deleteFormAction: '' }">
        <div class="bg-white border border-brand-border-card rounded-xl">
            <div class="p-6 border-b border-brand-border-card">
                <h2 class="text-lg font-bold text-brand-ink">Daftar Kajian</h2>
                <p class="text-sm text-brand-ink-soft mt-1">Kelola semua jadwal kajian yang Anda selenggarakan.</p>
            </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-brand-border-card">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Judul Kajian</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border-card">
                    @forelse($kajians as $kajian)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="font-medium text-brand-ink">{{ $kajian->title }}</div>
                                <div class="text-sm text-brand-ink-soft mt-1">{{ $kajian->category->name ?? '-' }} • {{ $kajian->speaker->name ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-brand-ink">{{ \Carbon\Carbon::parse($kajian->start_at)->format('d M Y') }}</div>
                                <div class="text-xs text-brand-ink-soft mt-1">{{ \Carbon\Carbon::parse($kajian->start_at)->format('H:i') }} - {{ \Carbon\Carbon::parse($kajian->end_at)->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($kajian->status === 'draft')
                                    <x-admin.badge variant="neutral">Draft</x-admin.badge>
                                @elseif($kajian->status === 'published')
                                    <x-admin.badge variant="success">Dipublikasikan</x-admin.badge>
                                @elseif($kajian->status === 'ongoing')
                                    <x-admin.badge variant="live">Berlangsung</x-admin.badge>
                                @elseif($kajian->status === 'finished')
                                    <x-admin.badge>Selesai</x-admin.badge>
                                @elseif($kajian->status === 'cancelled')
                                    <x-admin.badge variant="danger">Dibatalkan</x-admin.badge>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <x-admin.button variant="secondary" size="sm" :href="route('organizer.kajian.edit', $kajian->slug)">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                                </x-admin.button>
                                <x-admin.button variant="danger" size="sm" @click="deleteModalOpen = true; deleteFormAction = '{{ route('organizer.kajian.destroy', $kajian->slug) }}'">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Hapus
                                </x-admin.button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-brand-ink-soft">
                                Belum ada kajian yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Modal -->
    <x-delete-modal 
        title="Hapus Kajian" 
        message="Apakah Anda yakin ingin menghapus kajian ini? Data yang sudah dihapus tidak dapat dikembalikan." 
        closeAction="deleteModalOpen = false" 
    />
    </div>
</x-organizer-layout>
