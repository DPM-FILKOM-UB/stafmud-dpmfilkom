@props(['data'])

<div class="relative min-h-screen overflow-hidden">
    <div class="pointer-events-none absolute -top-48 right-0 h-[26rem] w-[26rem] rounded-full bg-dpm-orange/10 blur-3xl">
    </div>

    <div class="relative mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Tabel aspirasi terbaru --}}
        <section class="mt-6 rounded-card border border-dpm-border bg-dpm-card p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold">Semua Aspirasi</h2>
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
                        @forelse ($data as $a)
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

        <footer class="mt-8 rounded-card bg-dpm-footer px-6 py-4 text-center text-xs text-dpm-muted">
            &copy; {{ date('Y') }} DPM. Hak cipta dilindungi.
        </footer>
    </div>
</div>
