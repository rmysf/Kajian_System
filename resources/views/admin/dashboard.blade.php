<x-admin-layout>
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <x-admin.stat-card label="Total Kajian" :value="$totalKajian ?? 0" icon="book-open" />
        <x-admin.stat-card label="Kajian Hari Ini" :value="$kajianHariIni ?? 0" icon="calendar-clock" variant="warning" />
        <x-admin.stat-card label="Total User Aktif" :value="$totalUser ?? 0" icon="users" />
        <x-admin.stat-card label="Total Penyelenggara" :value="$totalOrganizer ?? 0" icon="building" />
    </div>

</x-admin-layout>

