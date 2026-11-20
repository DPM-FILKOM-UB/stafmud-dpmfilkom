<?php

namespace App\Http\Controllers;

use App\Aspirasi;
use App\Http\Requests\StoreAspirasiRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AspirasiController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function store(StoreAspirasiRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $uploadedPaths = [];
        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                $path = $file->store('bukti_aspirasi', 'public');
                $uploadedPaths[] = $path;
            }
        }

        $jenisAspirasiFinal = $validated['jenis_aspirasi'] === 'Other'
            ? $validated['jenis_aspirasi_other']
            : $validated['jenis_aspirasi'];

        Aspirasi::create([
            'nama' => $validated['nama'] ?? 'Anonim',
            'prodi' => $validated['prodi'],
            'kontak' => $validated['kontak'],
            'jenis_aspirasi' => $jenisAspirasiFinal,
            'aspirasi' => $validated['aspirasi'],
            'waktu_kejadian' => $validated['waktu_kejadian'],
            'bukti_files' => $uploadedPaths,
            'submitted_at' => now()->toDateTimeString(),
        ]);

        return redirect()->route('home')
            ->with('success', 'Aspirasi Anda berhasil dikirimkan ke DPM FILKOM UB! Kami akan mengawal aspirasi ini hingga mendapat tindak lanjut.')
            ->withFragment('form-aspirasi');
    }
}
