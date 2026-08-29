<x-admin-layout>
    <x-slot name="header">
        Master Data: Pemateri
    </x-slot>

    <div x-data="{ deleteModalOpen: false, deleteFormAction: '', detailModalOpen: false, selectedSpeaker: null }">
        <div class="bg-white border border-brand-border-card rounded-xl mb-6">
            <div class="p-6 border-b border-brand-border-card flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div>
                    <h2 class="text-lg font-bold text-brand-ink">Daftar Pemateri / Ustadz</h2>
                    <p class="text-sm text-brand-ink-soft mt-1">Kelola database profil asatidzah.</p>
                </div>
                <x-admin.button variant="primary" :href="route('admin.speaker.create')" class="mt-4 sm:mt-0">
                    <i data-lucide="plus" class="w-4 h-4 mr-1.5"></i> Tambah Pemateri
                </x-admin.button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-brand-border-card">
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Nama Pemateri</th>
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-border-card">
                        @forelse($speakers as $speaker)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-brand-ink">{{ $speaker->name }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @php
                                    $speakerData = [
                                        'name' => $speaker->name,
                                        'photo' => $speaker->photo ? Storage::url($speaker->photo) : null,
                                        'description' => $speaker->description,
                                        'created_at' => $speaker->created_at ? $speaker->created_at->format('d M Y') : '-',
                                        'edit_url' => route('admin.speaker.edit', $speaker->id)
                                    ];
                                @endphp
                                <x-admin.button variant="ghost" size="sm" @click="detailModalOpen = true; selectedSpeaker = {{ json_encode($speakerData) }}">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Detail
                                </x-admin.button>
                                <x-admin.button variant="danger" size="sm" @click="deleteModalOpen = true; deleteFormAction = '{{ route('admin.speaker.destroy', $speaker->id) }}'">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Hapus
                                </x-admin.button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-brand-ink-soft">
                                Belum ada data pemateri.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delete Modal -->
        <x-delete-modal 
            title="Hapus Pemateri" 
            message="Apakah Anda yakin ingin menghapus data pemateri ini? Semua data terkait mungkin akan terpengaruh. Tindakan ini tidak dapat dibatalkan." 
            closeAction="deleteModalOpen = false" 
        />

        <!-- Detail Modal -->
        <div x-show="detailModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div x-show="detailModalOpen" x-transition.opacity class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" aria-hidden="true" @click="detailModalOpen = false"></div>
                
                <div x-show="detailModalOpen" x-transition.scale.origin.center class="relative inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle w-full max-w-3xl border border-brand-border-card" role="dialog" aria-modal="true">
                    
                    <div class="flex flex-col md:flex-row w-full bg-white">
                        <!-- Bagian Kiri: Foto Full -->
                        <div class="w-full md:w-2/5 lg:w-1/3 h-64 md:h-auto relative bg-brand-emerald-100 shrink-0 border-b md:border-b-0 md:border-r border-brand-border-card">
                            <template x-if="selectedSpeaker?.photo">
                                <img :src="selectedSpeaker?.photo" :alt="selectedSpeaker?.name" class="absolute inset-0 w-full h-full object-cover">
                            </template>
                            <template x-if="!selectedSpeaker?.photo">
                                <div class="absolute inset-0 w-full h-full flex items-center justify-center">
                                    <svg class="w-24 h-24 text-brand-emerald-700 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            </template>
                        </div>

                        <!-- Bagian Kanan: Detail Text -->
                        <div class="relative w-full md:w-3/5 lg:w-2/3 p-6 md:p-8 bg-white flex flex-col">
                            <button type="button" @click="detailModalOpen = false" class="absolute top-4 right-4 text-brand-ink-soft hover:text-brand-danger bg-gray-50 hover:bg-brand-danger-soft rounded-full p-2 transition">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>

                            <div class="mb-6 pr-10">
                                <h2 class="text-2xl font-bold text-brand-ink mb-1" x-text="selectedSpeaker?.name"></h2>
                                <p class="text-sm text-brand-ink-soft">Ditambahkan pada: <span x-text="selectedSpeaker?.created_at"></span></p>
                            </div>

                            <h3 class="text-base font-bold text-brand-ink mb-3 border-b border-brand-border-card pb-2">Biografi / Deskripsi</h3>
                            
                            <div class="prose prose-sm max-w-none text-brand-ink-soft overflow-y-auto max-h-48 mb-6" style="white-space: pre-line;">
                                <template x-if="selectedSpeaker?.description">
                                    <span x-text="selectedSpeaker.description"></span>
                                </template>
                                <template x-if="!selectedSpeaker?.description">
                                    <p class="italic text-brand-nav-inactive">Belum ada biografi atau deskripsi untuk pemateri ini.</p>
                                </template>
                            </div>

                            <!-- Footer -->
                            <div class="mt-auto pt-6 border-t border-brand-border-card flex justify-end">
                                <x-admin.button variant="secondary" x-bind:href="selectedSpeaker?.edit_url" ::href="selectedSpeaker?.edit_url">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1.5"></i> Edit Profil
                                </x-admin.button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
