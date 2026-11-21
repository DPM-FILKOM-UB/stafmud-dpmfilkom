<?php

namespace App\Http\Controllers;

use App\Aspirasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index(Request $request)
    {

        $total = Aspirasi::count();

        return view('admin_page', [
            'page' => 'dashboard',
            'data' => [
                'adminName' => $request->user()->nama ?? 'Admin',
                'dateLabel' => now()->translatedFormat('l, d F Y'),
                'stats'     => $this->stats($total),
                'bars'      => $this->weeklyBars(),
                'byJenis'   => $this->byJenis($total),
                'latest'    => $this->latest(),
            ]
        ]);
    }

    private function stats(int $total): array
    {
        $thisMonth = Aspirasi::where('submitted_at', '>=', now()->startOfMonth())->count();
        $lastMonth = Aspirasi::whereBetween('submitted_at', [
            now()->subMonth()->startOfMonth()->toDateString(),
            now()->subMonth()->endOfMonth()->toDateString(),
        ])->count();

        $growth = $lastMonth > 0
            ? round((($thisMonth - $lastMonth) / $lastMonth) * 100, 1)
            : null;

        $top = Aspirasi::selectRaw('jenis_aspirasi, COUNT(*) as total')
            ->groupBy('jenis_aspirasi')
            ->orderByDesc('total')
            ->first();

        $withBukti = Aspirasi::whereJsonLength('bukti_files', '>', 0)->count();

        return [
            [
                'label' => 'Total Aspirasi',
                'value' => number_format($total, 0, ',', '.'),
                'delta' => null,
                'up'    => null,
            ],
            [
                'label' => 'Masuk Bulan Ini',
                'value' => number_format($thisMonth, 0, ',', '.'),
                'delta' => $growth === null
                    ? 'baru'
                    : ($growth >= 0 ? '+' : '') . str_replace('.', ',', (string) $growth) . '%',
                'up'    => $growth === null ? null : $growth >= 0,
            ],
            [
                'label' => 'Jenis Terbanyak',
                'value' => $top?->jenis_aspirasi ?? '-',
                'delta' => $top ? $top->total . ' aspirasi' : null,
                'up'    => null,
            ],
            [
                'label' => 'Disertai Bukti',
                'value' => number_format($withBukti, 0, ',', '.'),
                'delta' => $total > 0 ? round($withBukti / $total * 100) . '% dari total' : null,
                'up'    => null,
            ],
        ];
    }

    /** Jumlah aspirasi per hari selama 7 hari terakhir, dalam persen tinggi batang. */
    private function weeklyBars(): array
    {
        $start = now()->subDays(6)->startOfDay();

        $counts = Aspirasi::where('submitted_at', '>=', $start->toDateString())
            ->selectRaw('submitted_at, COUNT(*) as total')
            ->groupBy('submitted_at')
            ->pluck('total', 'submitted_at')
            ->mapWithKeys(fn($v, $k) => [Carbon::parse($k)->toDateString() => $v]);

        $series = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $start->copy()->addDays($i);
            $series[$date->locale('id')->isoFormat('ddd')] = [
                'count' => (int) ($counts[$date->toDateString()] ?? 0),
            ];
        }

        $max = max(array_column($series, 'count')) ?: 1;

        return array_map(fn($s) => [
            'count' => $s['count'],
            'pct'   => max(4, (int) round($s['count'] / $max * 100)),
        ], $series);
    }

    /** 4 jenis aspirasi terbanyak beserta persentasenya. */
    private function byJenis(int $total): array
    {
        if ($total === 0) {
            return [];
        }

        return Aspirasi::selectRaw('jenis_aspirasi, COUNT(*) as total')
            ->groupBy('jenis_aspirasi')
            ->orderByDesc('total')
            ->limit(4)
            ->get()
            ->map(fn($r) => [
                'label' => $r->jenis_aspirasi,
                'count' => $r->total,
                'pct'   => (int) round($r->total / $total * 100),
            ])
            ->all();
    }

    private function latest(): array
    {


        return Aspirasi::latest('submitted_at')->latest('id')->limit(8)->get()
            ->map(function ($a) {
                $raw   = $a->bukti_files;
                $paths = is_string($raw) ? json_decode($raw, true) : $raw;
                $paths = is_array($paths) ? $paths : [];
                return [
                    'id'       => $a->id,
                    'nama'     => $a->nama,
                    'prodi'    => $a->prodi,
                    'kontak'   => $a->kontak,
                    'jenis_aspirasi'    => $a->jenis_aspirasi,
                    'aspirasi' => $a->aspirasi,
                    'waktu_kejadian' => $a->waktu_kejadian?->translatedFormat('d M Y'),
                    'submitted_at' => $a->submitted_at?->translatedFormat('d M Y'),
                    'bukti'    => $a->bukti_files,
                    'bukti_files' => array_map(fn($path) => [
                        'url'   => asset('storage/' . $path),
                        'name'  => basename($path),
                        'image' => preg_match('/\.(jpe?g|png|gif|webp)$/i', $path) === 1,
                    ], $paths),
                ];
            })
            ->all();
    }

    public function showAllAspirasi()
    {
        // $dataAspirasi = Aspirasi::all(['nama', 'prodi', 'kontak', 'jenis_aspirasi', 'aspirasi', 'waktu_kejadian', 'submitted_at', 'bukti_files']);
        $dataAspirasi = Aspirasi::all()
            ->map(function ($a) {
                $raw   = $a->bukti_files;
                $paths = is_string($raw) ? json_decode($raw, true) : $raw;
                $paths = is_array($paths) ? $paths : [];
                return [
                    'nama'     => $a->nama,
                    'prodi'    => $a->prodi,
                    'kontak'   => $a->kontak,
                    'jenis_aspirasi'    => $a->jenis_aspirasi,
                    'aspirasi' => $a->aspirasi,
                    'waktu_kejadian' => $a->waktu_kejadian?->translatedFormat('d M Y'),
                    'submitted_at' => $a->submitted_at?->translatedFormat('d M Y'),
                    'bukti'    => $a->bukti_files,
                    'bukti_files' => array_map(fn($path) => [
                        'url'   => asset('storage/' . $path),
                        'name'  => basename($path),
                        'image' => preg_match('/\.(jpe?g|png|gif|webp)$/i', $path) === 1,
                    ], $paths),
                ];
            });

        return view('admin_page', [
            'page' => 'aspirasi',
            'data' => $dataAspirasi
        ]);
    }
}
