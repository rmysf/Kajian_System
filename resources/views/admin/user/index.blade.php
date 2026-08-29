<x-admin-layout>
    <x-slot name="header">
        Kelola Pengguna
    </x-slot>

    <div x-data="{
        editModalOpen: false,
        deleteModalOpen: false,
        activeUser: null,
        
        openEditModal(user) {
            this.activeUser = user;
            this.editModalOpen = true;
        },
        openDeleteModal(user) {
            this.activeUser = user;
            this.deleteModalOpen = true;
        },
        closeModal() {
            this.editModalOpen = false;
            this.deleteModalOpen = false;
            setTimeout(() => { this.activeUser = null; }, 300);
        }
    }">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-bold text-brand-ink">Daftar Pengguna</h2>
                <p class="text-sm text-brand-ink-soft">Kelola akun dan ubah peran pengguna (User, Organizer, Admin).</p>
            </div>

            @if(session('success'))
                <div class="bg-green-50 text-green-800 p-4 border-b border-green-200 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 text-red-800 p-4 border-b border-red-200 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Peran (Role)</th>
                            <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-brand-ink">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($user->role === 'admin') bg-purple-100 text-purple-800
                                        @elseif($user->role === 'organizer') bg-brand-emerald-100 text-brand-emerald-950
                                        @else bg-gray-100 text-gray-800 @endif
                                    ">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button type="button" @click="openEditModal({{ json_encode([
                                        'id' => $user->id,
                                        'name' => $user->name,
                                        'email' => $user->email,
                                        'role' => $user->role,
                                        'update_url' => route('admin.user.update', $user->id),
                                        'delete_url' => route('admin.user.destroy', $user->id)
                                    ]) }})" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-brand-ink bg-white hover:bg-gray-50 transition" title="Edit Peran">
                                        <i data-lucide="edit-2" class="w-4 h-4 sm:mr-1.5"></i> <span class="hidden sm:inline">Edit Peran</span>
                                    </button>
                                    <button type="button" @click="openDeleteModal({{ json_encode([
                                        'id' => $user->id,
                                        'name' => $user->name,
                                        'email' => $user->email,
                                        'role' => $user->role,
                                        'update_url' => route('admin.user.update', $user->id),
                                        'delete_url' => route('admin.user.destroy', $user->id)
                                    ]) }})" class="inline-flex items-center px-3 py-1.5 border border-red-200 text-sm font-medium rounded-md text-red-600 bg-red-50 hover:bg-red-100 transition" title="Hapus Akun">
                                        <i data-lucide="trash-2" class="w-4 h-4 sm:mr-1.5"></i> <span class="hidden sm:inline">Hapus</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-brand-ink-soft">Belum ada pengguna.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Edit Role Modal -->
        <div x-show="editModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- Background overlay -->
            <div x-show="editModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>

            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <!-- Modal panel -->
                <div x-show="editModalOpen" x-transition.scale.origin.center class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 w-full max-w-md border border-gray-100">
                    
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                        <h3 class="text-lg font-bold text-brand-ink" id="modal-title">Ubah Peran (Role) Pengguna</h3>
                        <button type="button" @click="closeModal()" class="rounded-full p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 transition">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <!-- Modal Body & Form -->
                    <template x-if="activeUser">
                        <form :action="activeUser.update_url" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="px-6 py-5 bg-gray-50/50">
                                <div>
                                    <label for="role_select" class="block text-sm font-bold text-gray-700 mb-2">Pilih Peran Baru</label>
                                    <select id="role_select" name="role" x-model="activeUser.role" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-emerald-500 focus:ring-brand-emerald-500 sm:text-sm">
                                        <option value="user">User (Jamaah Biasa)</option>
                                        <option value="organizer">Organizer (Penyelenggara)</option>
                                        <option value="admin">Admin (Pengelola Sistem)</option>
                                    </select>
                                    <p class="text-xs text-gray-500 mt-2">
                                        <i data-lucide="info" class="w-3 h-3 inline mr-1"></i> Perubahan peran akan langsung memengaruhi akses pengguna tersebut di aplikasi.
                                    </p>
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="bg-white px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                                <button type="button" @click="closeModal()" class="px-4 py-2 bg-white text-gray-700 border border-gray-300 font-bold rounded-lg hover:bg-gray-50 transition text-sm">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-brand-emerald-900 text-white font-bold rounded-lg hover:bg-brand-emerald-950 shadow-sm transition text-sm flex items-center">
                                    <i data-lucide="save" class="w-4 h-4 mr-2"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </template>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <x-delete-modal 
            title="Hapus Akun Pengguna" 
            message="Apakah Anda yakin ingin menghapus akun <span class='font-bold text-gray-700' x-text='activeUser ? activeUser.name : &quot;&quot;'></span> secara permanen? Semua data terkait (termasuk kajian jika ia Organizer) mungkin akan ikut terhapus atau dibatalkan."
            closeAction="closeModal()"
            formAction="activeUser ? activeUser.delete_url : ''"
        />
    </div>
</x-admin-layout>
