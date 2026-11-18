<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAspirasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['nullable', 'string', 'max:120'],
            'prodi' => ['required', 'string', 'in:Sistem Informasi,Teknik Informatika,Pendidikan Teknologi Informasi,Teknik Komputer,Teknologi Informasi'],
            'kontak' => ['required', 'string', 'max:100'],
            'jenis_aspirasi' => ['required', 'string', 'in:Sarana dan Prasarana,Akademik,Kemahasiswaan,Lembaga,Other'],
            'jenis_aspirasi_other' => ['required_if:jenis_aspirasi,Other', 'nullable', 'string', 'max:100'],
            'aspirasi' => ['required', 'string', 'min:10', 'max:2500'],
            'waktu_kejadian' => ['required', 'date', 'before_or_equal:now'],
            'bukti' => ['nullable', 'array', 'max:5'],
            'bukti.*' => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'prodi.required' => 'Pilih salah satu Program Studi di FILKOM.',
            'prodi.in' => 'Program Studi yang dipilih tidak valid.',
            'kontak.required' => 'Kontak yang dapat dihubungi wajib diisi.',
            'jenis_aspirasi.required' => 'Silakan tentukan jenis aspirasi Anda.',
            'jenis_aspirasi.in' => 'Jenis aspirasi tidak terdaftar.',
            'jenis_aspirasi_other.required_if' => 'Mohon sebutkan jenis aspirasi yang Anda maksud.',
            'aspirasi.required' => 'Uraian aspirasi tidak boleh kosong.',
            'aspirasi.min' => 'Aspirasi terlalu singkat, mohon uraikan minimal 10 karakter.',
            'aspirasi.max' => 'Aspirasi melebihi batas maksimal 2500 karakter.',
            'waktu_kejadian.required' => 'Waktu kejadian wajib diisi.',
            'waktu_kejadian.date' => 'Format waktu kejadian tidak valid.',
            'waktu_kejadian.before_or_equal' => 'Waktu kejadian tidak boleh mendahului waktu saat ini.',
            'bukti.max' => 'Maksimal bukti pendukung yang diunggah adalah 5 file.',
            'bukti.*.mimes' => 'Format file pendukung harus berupa PDF, JPG, JPEG, atau PNG.',
            'bukti.*.max' => 'Ukuran file pendukung maksimal 5 MB per file.',
        ];
    }
}
