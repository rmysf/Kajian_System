<x-admin-layout>
    <x-slot name="header">
        Master Data: Kategori
    </x-slot>

    <div x-data="{ 
            deleteModalOpen: false, 
            deleteFormAction: '',
            
            editModalOpen: false,
            activeCategory: null,
            
            addModalOpen: false,
            
            openEditModal(category) {
                this.activeCategory = category;
                this.editModalOpen = true;
            }
        }" class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h2 class="text-lg font-bold text-brand-ink">Daftar Kategori</h2>
                <p class="text-sm text-brand-ink-soft">Kelola referensi kategori untuk kajian.</p>
            </div>
            <button type="button" @click="addModalOpen = true" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-brand-emerald-900 text-white text-sm font-medium rounded-lg hover:bg-brand-emerald-950 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-emerald-900">
                <i data-lucide="plus-circle" class="w-4 h-4 mr-2"></i> Tambah Kategori
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 font-medium text-brand-ink">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @php
                                    $catData = [
                                        'id' => $category->id,
                                        'name' => $category->name,
                                        'slug' => $category->slug,
                                        'update_url' => route('admin.category.update', $category->slug)
                                    ];
                                @endphp
                                <button type="button" @click='openEditModal(@json($catData))' class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-brand-ink bg-white hover:bg-gray-50 transition" title="Edit">
                                    <i data-lucide="edit" class="w-4 h-4 sm:mr-1.5"></i>
                                    <span class="hidden sm:inline">Edit</span>
                                </button>
                                <button type="button" @click="deleteModalOpen = true; deleteFormAction = '{{ route('admin.category.destroy', $category->slug) }}'" class="inline-flex items-center px-3 py-1.5 border border-brand-danger text-sm font-medium rounded-md text-white bg-brand-danger hover:bg-red-700 transition" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4 sm:mr-1.5"></i>
                                    <span class="hidden sm:inline">Hapus</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="grid" class="w-12 h-12 text-gray-300 mb-3"></i>
                                    <p class="text-brand-ink font-medium">Belum ada kategori</p>
                                    <p class="text-sm mt-1">Tambahkan kategori pertama Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        
        <div x-show="addModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="addModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" @click="addModalOpen = false"></div>

            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div x-show="addModalOpen" x-transition.scale.origin.center class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 w-full max-w-md border border-gray-100 flex flex-col">
                    <form action="{{ route('admin.category.store') }}" method="POST">
                        @csrf
                        
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                            <h3 class="text-lg font-bold text-gray-900" id="modal-title">Tambah Kategori</h3>
                            <button type="button" @click="addModalOpen = false" class="text-gray-400 hover:text-gray-500">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>
                        
                        <div class="px-6 py-5 bg-white">
                            <div>
                                <label for="add_name" class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                                <input type="text" id="add_name" name="name" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-brand-emerald-900 focus:outline-none focus:ring-1 focus:ring-brand-emerald-900" required placeholder="Contoh: Fiqih">
                            </div>
                        </div>

                        <div class="bg-gray-50/50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 rounded-b-2xl">
                            <button type="button" @click="addModalOpen = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition">
                                Batal
                            </button>
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-brand-emerald-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-emerald-950 sm:w-auto transition">
                                Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div x-show="editModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="editModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" @click="editModalOpen = false"></div>

            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div x-show="editModalOpen" x-transition.scale.origin.center class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 w-full max-w-md border border-gray-100 flex flex-col">
                    <template x-if="activeCategory">
                        <form :action="activeCategory.update_url" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                                <h3 class="text-lg font-bold text-gray-900" id="modal-title">Edit Kategori</h3>
                                <button type="button" @click="editModalOpen = false" class="text-gray-400 hover:text-gray-500">
                                    <i data-lucide="x" class="w-5 h-5"></i>
                                </button>
                            </div>
                            
                            <div class="px-6 py-5 bg-white">
                                <div>
                                    <label for="edit_name" class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                                    <input type="text" id="edit_name" name="name" x-model="activeCategory.name" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-brand-emerald-900 focus:outline-none focus:ring-1 focus:ring-brand-emerald-900" required>
                                </div>
                            </div>

                            <div class="bg-gray-50/50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 rounded-b-2xl">
                                <button type="button" @click="editModalOpen = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition">
                                    Batal
                                </button>
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-brand-emerald-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-emerald-950 sm:w-auto transition">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </template>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <x-delete-modal 
            title="Hapus Kategori" 
            message="Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan." 
            closeAction="closeModal()" 
        />
    </div>
</x-admin-layout>

