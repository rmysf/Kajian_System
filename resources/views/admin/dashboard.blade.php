<x-admin-layout>
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <x-admin.stat-card label="Total Kajian" :value="$totalKajian ?? 0" icon="book-open" :href="route('admin.kajian.index')" />
        <x-admin.stat-card label="Kajian Hari Ini" :value="$kajianHariIni ?? 0" icon="calendar-clock" variant="warning" :href="route('admin.kajian.index')" />
        <x-admin.stat-card label="Total User Aktif" :value="$totalUser ?? 0" icon="users" :href="route('admin.user.index')" />
        <x-admin.stat-card label="Total Penyelenggara" :value="$totalOrganizer ?? 0" icon="building" :href="route('admin.organizer.index')" />
    </div>

</x-admin-layout>
