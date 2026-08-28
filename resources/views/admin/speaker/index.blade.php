<x-admin-layout>
    <x-slot name="header">Data Master: Pemateri</x-slot>

    <div x-data="{ deleteId: null, deleteName: '', photoPreview: null }">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
            <div>
                <h2 class="text-xl font-bold text-[var(--ink)]">Pemateri / Ustadz</h2>
                <p class="text-sm text-[var(--ink-soft)] mt-0.5">Database profil asatidzah yang terdaftar di sistem.</p>
            </div>
            <a href="{{ route('admin.speaker.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold bg-[var(--emerald-900)] text-white hover:bg-[var(--emerald-950)] transition-colors shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Pemateri
            </a>
        </div>

        {{-- Grid --}}
        @if($speakers->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-5">
            @foreach($speakers as $speaker)
            <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm p-5 flex flex-col items-center text-center group hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="w-20 h-20 rounded-2xl overflow-hidden border-2 border-[var(--border-light)] mb-3 flex-shrink-0">
                    @if($speaker->photo)
                        <img src="{{ Storage::url($speaker->photo) }}" class="w-full h-full object-cover" alt="{{ $speaker->name }}">
                    @else
                        <div class="w-full h-full bg-[var(--emerald-100)] flex items-center justify-center text-2xl font-bold text-[var(--emerald-700)]">
                            {{ strtoupper(substr($speaker->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h3 class="text-sm font-semibold text-[var(--ink)] mb-1 leading-snug">{{ $speaker->name }}</h3>
                <p class="text-[11px] text-[var(--ink-soft)] line-clamp-2 mb-4">{{ $speaker->description ?: 'Belum ada biografi.' }}</p>
                <div class="flex gap-2 mt-auto w-full">
                    <a href="{{ route('admin.speaker.edit', $speaker->id) }}"
                       class="flex-1 flex items-center justify-center gap-1.5 py-2 text-xs font-semibold rounded-xl border border-[var(--border-light)] text-[var(--ink-soft)] hover:bg-[var(--cream)] hover:text-[var(--ink)] transition-colors">
                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i> Edit
                    </a>
                    <button
                        @click="deleteId = {{ $speaker->id }}; deleteName = '{{ addslashes($speaker->name) }}'; $dispatch('open-modal', 'delete-speaker')"
                        class="flex-1 flex items-center justify-center gap-1.5 py-2 text-xs font-semibold rounded-xl border border-[var(--danger-soft)] text-[var(--danger)] hover:bg-[var(--danger-soft)] transition-colors">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-2xl border border-[var(--border-card)] shadow-sm flex flex-col items-center justify-center py-16 text-center">
            <div class="w-14 h-14 rounded-2xl bg-[var(--cream)] flex items-center justify-center text-[var(--nav-inactive)] mb-3">
                <i data-lucide="mic-off" class="w-7 h-7"></i>
            </div>
            <p class="text-sm font-medium text-[var(--ink-soft)] mb-4">Belum ada data pemateri.</p>
            <a href="{{ route('admin.speaker.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-[var(--emerald-900)] text-white hover:bg-[var(--emerald-950)] transition-colors">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Pemateri Pertama
            </a>
        </div>
        @endif

        {{-- Delete Modal --}}
        <x-modal name="delete-speaker" title="Hapus Pemateri?">
            <p class="text-sm text-[var(--ink-soft)] mb-1">Anda akan menghapus pemateri:</p>
            <p class="text-sm font-semibold text-[var(--ink)] mb-4" x-text="deleteName"></p>
            <p class="text-sm text-[var(--ink-soft)]">Tindakan ini tidak dapat dibatalkan.</p>
            <x-slot name="footer">
                <button @click="$dispatch('close-modal', 'delete-speaker')"
                        class="px-4 py-2 text-sm font-medium rounded-xl border border-[var(--border-light)] text-[var(--ink-soft)] hover:bg-[var(--cream)] transition-colors">
                    Batal
                </button>
                <form :action="`{{ url('admin/speaker') }}/${deleteId}`" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-xl bg-[var(--danger)] text-white hover:opacity-90 transition-opacity">
                        Ya, Hapus
                    </button>
                </form>
            </x-slot>
        </x-modal>
    </div>
</x-admin-layout>
