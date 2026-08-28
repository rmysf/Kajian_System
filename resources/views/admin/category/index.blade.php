<x-admin-layout>
    <x-slot name="header">Data Master: Kategori</x-slot>

    <div x-data="{ editId: null, editName: '', deleteId: null }">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
            <div>
                <h2 class="text-xl font-bold text-[var(--ink)]">Kategori Kajian</h2>
                <p class="text-sm text-[var(--ink-soft)] mt-0.5">Kelola kategori/tema untuk mengklasifikasikan kajian.</p>
            </div>
            <button @click="editId = null; editName = ''; $dispatch('open-modal', 'category-form')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold bg-[var(--emerald-900)] text-white hover:bg-[var(--emerald-950)] transition-colors shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kategori
            </button>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-[var(--border-light)]">
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)]">Nama Kategori</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)]">Slug</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] hidden md:table-cell">Jumlah Kajian</th>
                            <th class="px-5 py-3.5 text-[11px] font-semibold uppercase tracking-wide text-[var(--ink-soft)] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-light)]">
                        @forelse($categories as $category)
                        <tr class="hover:bg-[var(--cream)] transition-colors">
                            <td class="px-5 py-4 text-sm font-semibold text-[var(--ink)]">{{ $category->name }}</td>
                            <td class="px-5 py-4 text-sm text-[var(--ink-soft)] font-mono">{{ $category->slug }}</td>
                            <td class="px-5 py-4 text-sm text-[var(--ink-soft)] hidden md:table-cell">{{ $category->kajians()->count() }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        @click="editId = {{ $category->id }}; editName = '{{ addslashes($category->name) }}'; $dispatch('open-modal', 'category-form')"
                                        class="p-2 rounded-lg text-[var(--ink-soft)] hover:bg-[var(--border-light)] hover:text-[var(--ink)] transition-colors">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </button>
                                    <button
                                        @click="deleteId = {{ $category->id }}; $dispatch('open-modal', 'delete-category')"
                                        class="p-2 rounded-lg text-[var(--ink-soft)] hover:bg-[var(--danger-soft)] hover:text-[var(--danger)] transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center text-sm text-[var(--ink-soft)]">Belum ada kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Add/Edit Modal --}}
        <x-modal name="category-form" :title="'Kategori'">
            <form :action="editId ? `{{ url('admin/category') }}/${editId}` : '{{ route('admin.category.store') }}'" method="POST" x-ref="categoryForm">
                @csrf
                <span x-show="editId" style="display:none;">
                    <input type="hidden" name="_method" value="PUT">
                </span>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[var(--ink)] mb-1.5">Nama Kategori <span class="text-[var(--danger)]">*</span></label>
                        <input type="text" name="name" :value="editName" required placeholder="Contoh: Fiqih, Aqidah, Tafsir..."
                               class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-[var(--border-light)] bg-white focus:outline-none focus:ring-2 focus:ring-[var(--emerald-500)]">
                    </div>
                    <p class="text-xs text-[var(--ink-soft)]">Slug akan dibuat otomatis dari nama.</p>
                </div>
                <x-slot name="footer">
                    <button type="button" @click="$dispatch('close-modal', 'category-form')"
                            class="px-4 py-2 text-sm font-medium rounded-xl border border-[var(--border-light)] text-[var(--ink-soft)] hover:bg-[var(--cream)] transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-sm font-semibold rounded-xl bg-[var(--emerald-900)] text-white hover:bg-[var(--emerald-950)] transition-colors">
                        Simpan
                    </button>
                </x-slot>
            </form>
        </x-modal>

        {{-- Delete Modal --}}
        <x-modal name="delete-category" title="Hapus Kategori?">
            <p class="text-sm text-[var(--ink-soft)]">Menghapus kategori ini dapat mempengaruhi kajian yang sudah menggunakannya. Lanjutkan?</p>
            <x-slot name="footer">
                <button @click="$dispatch('close-modal', 'delete-category')"
                        class="px-4 py-2 text-sm font-medium rounded-xl border border-[var(--border-light)] text-[var(--ink-soft)] hover:bg-[var(--cream)] transition-colors">
                    Batal
                </button>
                <form :action="`{{ url('admin/category') }}/${deleteId}`" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-xl bg-[var(--danger)] text-white hover:opacity-90 transition-opacity">
                        Ya, Hapus
                    </button>
                </form>
            </x-slot>
        </x-modal>
    </div>
</x-admin-layout>
