{{-- 
    Komponen Status Badge — Satu sumber kebenaran untuk semua badge status
    Props: $status (string: 'draft'|'published'|'ongoing'|'done'|'cancelled'|'verified'|'unverified')
    Usage: <x-status-badge status="draft" />
--}}
@props(['status'])

@php
$map = [
    'draft'       => ['label' => 'Draft',       'bg' => 'bg-[var(--border-light)]', 'text' => 'text-[var(--ink-soft)]'],
    'published'   => ['label' => 'Publikasi',    'bg' => 'bg-[var(--emerald-100)]',  'text' => 'text-[var(--emerald-700)]'],
    'ongoing'     => ['label' => 'Berlangsung',  'bg' => 'bg-orange-100',            'text' => 'text-[var(--badge-live)]'],
    'done'        => ['label' => 'Selesai',      'bg' => 'bg-[var(--border-light)]', 'text' => 'text-[var(--ink-soft)]'],
    'cancelled'   => ['label' => 'Dibatalkan',   'bg' => 'bg-[var(--danger-soft)]',  'text' => 'text-[var(--danger-text)]'],
    'verified'    => ['label' => 'Terverifikasi','bg' => 'bg-[var(--gold-soft)]',    'text' => 'text-[var(--gold-text)]'],
    'unverified'  => ['label' => 'Belum Verif.','bg' => 'bg-[var(--border-light)]', 'text' => 'text-[var(--ink-soft)]'],
    'registered'  => ['label' => 'Terdaftar',    'bg' => 'bg-[var(--emerald-100)]',  'text' => 'text-[var(--emerald-700)]'],
    'attended'    => ['label' => 'Hadir',        'bg' => 'bg-[var(--gold-soft)]',    'text' => 'text-[var(--gold-text)]'],
    'absent'      => ['label' => 'Absen',        'bg' => 'bg-[var(--danger-soft)]',  'text' => 'text-[var(--danger-text)]'],
];

$style = $map[$status] ?? ['label' => ucfirst($status), 'bg' => 'bg-gray-100', 'text' => 'text-gray-600'];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[11px] font-semibold leading-5 {{ $style['bg'] }} {{ $style['text'] }}">
    {{ $style['label'] }}
</span>
