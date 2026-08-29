<x-admin-layout>
    <x-slot name="header">
        Moderasi Penyelenggara
    </x-slot>

    <div class="bg-white border border-brand-border-card rounded-xl">
        <div class="p-6 border-b border-brand-border-card">
            <h2 class="text-lg font-bold text-brand-ink">Daftar Akun Penyelenggara</h2>
            <p class="text-sm text-brand-ink-soft mt-1">Kelola status verifikasi akun organizer agar mereka bisa membuat kajian publik.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-brand-border-card">
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Nama Organizer</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-brand-ink-soft uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border-card">
                    @forelse($organizers as $organizer)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-brand-ink">{{ $organizer->name }}</td>
                            <td class="px-6 py-4 text-sm text-brand-ink-soft">{{ $organizer->user->email ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($organizer->is_verified)
                                    <x-admin.badge variant="success">Terverifikasi</x-admin.badge>
                                @else
                                    <x-admin.badge variant="warning">Belum Diverifikasi</x-admin.badge>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.organizer.verify', $organizer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @if($organizer->is_verified)
                                        <x-admin.button variant="ghost" size="sm" type="submit">
                                            Cabut Verifikasi
                                        </x-admin.button>
                                    @else
                                        <x-admin.button variant="primary" size="sm" type="submit">
                                            Verifikasi Sekarang
                                        </x-admin.button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-brand-ink-soft">Belum ada penyelenggara.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
