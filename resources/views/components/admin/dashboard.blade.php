@props(['data'])

@php
    $adminName = $data['adminName'] ?? 'Admin';
    $dateLabel = $data['dateLabel'] ?? '';
    $stats = $data['stats'] ?? [];
    $bars = $data['bars'] ?? [];
    $byJenis = $data['byJenis'] ?? [];
    $latest = $data['latest'] ?? [];
@endphp



<div class="relative min-h-screen overflow-hidden">
    <div class="pointer-events-none absolute -top-48 right-0 h-[26rem] w-[26rem] rounded-full bg-dpm-orange/10 blur-3xl">
    </div>

    <div class="relative mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{-- Header (bukan navbar) --}}
        <header class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm text-dpm-muted">{{ now()->translatedFormat('l, d F Y') }}</p>
                <h1 class="mt-1 text-3xl font-bold tracking-tight">
                    Halo, <span
                        class="bg-gradient-to-r from-dpm-orange-light to-dpm-gold-bright bg-clip-text text-transparent">{{ $adminName }}</span>
                </h1>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="rounded-xl border border-dpm-border bg-dpm-card px-4 py-2.5 text-sm font-medium text-dpm-cream transition hover:text-dpm-gold-bright hover:shadow-glow-orange">
                    Keluar
                </button>
            </form>
        </header>

        {{-- Statistik --}}
        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($stats as $s)
                <div class="rounded-card border border-dpm-border bg-dpm-card p-5 transition hover:shadow-glow-orange">
                    <p class="text-sm text-dpm-muted">{{ $s['label'] }}</p>
                    <p class="mt-3 truncate text-3xl font-bold text-dpm-cream" title="{{ $s['value'] }}">
                        {{ $s['value'] }}</p>
                    @if ($s['delta'])
                        <span
                            class="mt-3 inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium
                            {{ $s['up'] === null ? 'bg-dpm-gold/10 text-dpm-gold-bright' : ($s['up'] ? 'bg-emerald-500/10 text-emerald-300' : 'bg-red-500/10 text-red-400') }}">
                            @if ($s['up'] !== null)
                                {{ $s['up'] ? '↑' : '↓' }}&nbsp;
                            @endif{{ $s['delta'] }}
                        </span>
                    @endif
                </div>
            @endforeach
        </section>

        <section class="mt-6 grid gap-6 lg:grid-cols-3">
            {{-- Grafik 7 hari --}}
            <div class="rounded-card border border-dpm-border bg-dpm-card p-6 lg:col-span-2">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold">Aspirasi Masuk</h2>
                        <p class="text-sm text-dpm-muted">Jumlah per hari</p>
                    </div>
                    <span class="rounded-full bg-dpm-gold/10 px-3 py-1 text-xs font-medium text-dpm-gold-bright">7 hari
                        terakhir</span>
                </div>
                <div class="mt-8 flex h-56 items-end gap-3">
                    @foreach ($bars as $day => $bar)
                        <div class="flex flex-1 flex-col items-center gap-2" title="{{ $bar['count'] }} aspirasi">
                            <span class="text-xs font-medium text-dpm-gold">{{ $bar['count'] }}</span>
                            <div class="flex w-full flex-1 items-end rounded-xl bg-dpm-surface">
                                <div class="w-full rounded-xl bg-gradient-to-t from-dpm-orange to-dpm-gold-bright"
                                    style="height: {{ $bar['pct'] }}%"></div>
                            </div>
                            <span class="text-xs text-dpm-muted">{{ $day }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Jenis aspirasi --}}
            <div class="rounded-card border border-dpm-border bg-dpm-card p-6">
                <h2 class="text-lg font-semibold">Jenis Aspirasi</h2>
                <p class="text-sm text-dpm-muted">Persentase dari seluruh aspirasi</p>
                <div class="mt-6 space-y-5">
                    @forelse ($byJenis as $j)
                        <div>
                            <div class="mb-2 flex justify-between gap-3 text-sm">
                                <span class="truncate text-dpm-cream">{{ $j['label'] }}</span>
                                <span class="shrink-0 text-dpm-gold">{{ $j['count'] }} · {{ $j['pct'] }}%</span>
                            </div>
                            <div class="h-2 rounded-full bg-dpm-gray">
                                <div class="h-2 rounded-full bg-gradient-to-r from-dpm-orange to-dpm-gold-bright"
                                    style="width: {{ $j['pct'] }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-dpm-muted">Belum ada data.</p>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Tabel aspirasi terbaru --}}
        <section class="mt-6 rounded-card border border-dpm-border bg-dpm-card p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold">Aspirasi Terbaru</h2>
                <a href={{ route('admin.aspirasi') }}
                    class="text-sm text-dpm-orange-light transition hover:text-dpm-gold-bright">Lihat
                    semua →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[52rem] text-left text-sm">
                    <thead>
                        <tr class="border-b border-dpm-gray text-dpm-muted">
                            <th class="pb-3 font-medium">Pengirim</th>
                            <th class="pb-3 font-medium">Jenis</th>
                            <th class="pb-3 font-medium">Aspirasi</th>
                            <th class="pb-3 font-medium">Kejadian</th>
                            <th class="pb-3 font-medium">Diajukan</th>
                            <th class="pb-3 font-medium">Bukti</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dpm-gray/60">
                        @forelse ($latest as $a)
                            <tr class="align-top transition hover:bg-dpm-surface/60">
                                <td class="py-4 pr-4">
                                    <p class="font-medium text-dpm-cream">{{ $a['nama'] }}</p>
                                    <p class="text-xs text-dpm-muted">{{ $a['prodi'] }}</p>
                                    <p class="text-xs text-dpm-muted">{{ $a['kontak'] }}</p>
                                </td>
                                <td class="py-4 pr-4">
                                    <span
                                        class="whitespace-nowrap rounded-full bg-dpm-orange/15 px-2.5 py-1 text-xs font-medium text-dpm-orange-light">{{ $a['jenis_aspirasi'] }}</span>
                                </td>
                                <td class="max-w-xs py-4 pr-4 text-dpm-muted" title="{{ $a['aspirasi'] }}">
                                    {{ \Illuminate\Support\Str::limit($a['aspirasi'], 90) }}</td>
                                <td class="whitespace-nowrap py-4 pr-4 text-dpm-muted">
                                    {{ $a['waktu_kejadian'] }}</td>
                                <td class="whitespace-nowrap py-4 pr-4 text-dpm-muted">
                                    {{ $a['submitted_at'] }}</td>
                                @php $n = count($a['bukti'] ?? []); @endphp
                                <td class="py-4">
                                    @if ($a['bukti_files'])
                                        <button type="button" data-bukti-open
                                            data-title="{{ $a['nama'] }} · {{ $a['jenis_aspirasi'] }}"
                                            data-files="{{ json_encode($a['bukti_files']) }}"
                                            class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-lg border border-dpm-border bg-dpm-surface px-3 py-1.5 text-xs font-medium text-dpm-orange-light transition hover:text-dpm-gold-bright hover:shadow-glow-orange">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                                stroke-width="1.8" viewBox="0 0 24 24">
                                                <rect x="3" y="4" width="18" height="16" rx="2" />
                                                <circle cx="9" cy="10" r="1.5" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 16l-5-5-8 8" />
                                            </svg>
                                            Lihat bukti ({{ $n }})
                                        </button>
                                    @else
                                        <span
                                            class="whitespace-nowrap rounded-full bg-dpm-gray px-2.5 py-1 text-xs text-dpm-muted">Tidak
                                            ada</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-dpm-muted">Belum ada aspirasi masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
