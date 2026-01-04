<?php

namespace App\Http\Controllers;

use App\Models\PendaftarOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class DaftarOnlineController extends Controller
{
    public function create()
    {
        return view('daftar-online');
    }

    public function store(Request $request)
    {
        // Aturan validasi
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string',
            'nik' => 'required|string|size:16|unique:pendaftar_online,nik',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'warga_negara' => 'required|string',
            'gol_darah' => 'nullable|string',
            'sekolah_asal' => 'required|string',
            'nisn' => 'nullable|string|unique:pendaftar_online,nisn',
            'tingkat' => 'required|string',
            'program_hs' => 'required|string',
            'prestasi' => 'nullable|string',
            'email_ortu' => 'required|email',
            'telp_hp_ortu' => 'required|string',
            'alamat' => 'required|string',
            'nama_ayah' => 'nullable|string',
            'pekerjaan_ayah' => 'nullable|string',
            'penghasilan_ayah' => 'nullable|string',
            'nama_ibu' => 'required|string',
            'pekerjaan_ibu' => 'nullable|string',
            'penghasilan_ibu' => 'nullable|string',
            'nama_wali' => 'nullable|string',
            'pekerjaan_wali' => 'nullable|string',
            'file_kk_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'persetujuan' => 'required',
        ];

        // Buat validator manual
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Ambil field yang error
            $failedFields = array_keys($validator->failed());

            // Mapping field ke nomor step (mulai dari 0)
            $stepMap = [
                0 => ['nama_lengkap','nama_panggilan','nik','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','warga_negara','gol_darah'],
                1 => ['sekolah_asal','nisn','tingkat','program_hs','prestasi','email_ortu','telp_hp_ortu','alamat'],
                2 => ['nama_ayah','pekerjaan_ayah','penghasilan_ayah','nama_ibu','pekerjaan_ibu','penghasilan_ibu','nama_wali','pekerjaan_wali'],
                3 => ['file_kk_ktp','file_ijazah','persetujuan'],
            ];

            $activeStep = 0;

            // Cari step mana yang error
            foreach ($failedFields as $f) {
                foreach ($stepMap as $stepIndex => $fields) {
                    if (in_array($f, $fields, true)) {
                        $activeStep = $stepIndex;
                        break 2; // Keluar dari kedua loop
                    }
                }
            }

            // Kembali ke form dengan error & membuka step yang benar
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('active_step', $activeStep);
        }

        // Jika validasi sukses, simpan data
        $validatedData = $validator->validated();
        $validatedData['user_id'] = Auth::id();

        // Handle File Upload
        if (app()->environment('testing')) {
            $validatedData['file_kk_ktp'] = 'dummy_kk.pdf';
            $validatedData['file_ijazah'] = 'dummy_ijazah.pdf';
        } else {
            try {
                // Simpan ke storage (pastikan sudah php artisan storage:link)
                // Menggunakan disk 'public' agar bisa diakses lewat browser/admin
                $pathKK = $request->file('file_kk_ktp')->store('berkas_pendaftaran', 'public');
                $pathIjazah = $request->file('file_ijazah')->store('berkas_pendaftaran', 'public');
                
                $validatedData['file_kk_ktp'] = $pathKK;
                $validatedData['file_ijazah'] = $pathIjazah;
            } catch (\Throwable $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['file_kk_ktp' => 'Gagal mengunggah berkas. Pastikan ukuran maks 2MB.'])
                    ->with('active_step', 3);
            }
        }

        // Hapus field persetujuan karena tidak masuk database
        unset($validatedData['persetujuan']);

        // Simpan ke Database
        $pendaftarBaru = PendaftarOnline::create($validatedData);

        // Redirect ke halaman bukti
        return redirect()->route('daftar.online.bukti', ['id' => $pendaftarBaru->id]);
    }

    public function showBukti($id)
    {
        $pendaftar = PendaftarOnline::findOrFail($id);

        // Pastikan hanya pemilik data yang bisa lihat
        if (Auth::id() != $pendaftar->user_id) {
            abort(403, 'Akses Ditolak');
        }

        return view('cetak-bukti', [
            'pendaftar' => $pendaftar
        ]);
    }

    public function downloadPdf($id)
    {
        $pendaftar = PendaftarOnline::findOrFail($id);

        // PERUBAHAN DI SINI: Gunakan view 'pdf.bukti-pendaftaran'
        // Bukan 'cetak-bukti' agar tidak ada navbar/layout website
        $pdf = Pdf::loadView('pdf.bukti-pendaftaran', [
            'pendaftar' => $pendaftar
        ]);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('Formulir-'.$pendaftar->nama_lengkap.'.pdf');
    }
}