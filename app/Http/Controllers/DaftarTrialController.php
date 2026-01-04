<?php

namespace App\Http\Controllers;

use App\Models\PendaftarTrial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarTrialController extends Controller
{
    /**
     * Tampilkan halaman formulir daftar trial.
     */
    public function create()
    {
        return view('daftar-trial');
    }

    /**
     * Simpan data formulir ke database.
     */
    public function store(Request $request)
    {
        // Validasi server-side (sesuai aturan client-side)
        $validatedData = $request->validate([
            'nama_lengkap'    => ['required','string','max:255','regex:/^[A-Za-z\s]+$/'],
            'nama_panggilan'  => ['nullable','string','max:100','regex:/^[A-Za-z\s]*$/'],
            'jenis_kelamin'   => ['required','in:Laki-laki,Perempuan'],
            'asal_sekolah'    => ['required','string','max:255','regex:/^[A-Za-z0-9\s\.\-\,&()]+$/'],
            'dari_kelas'      => ['required','string','max:30'],
            'nama_orangtua'   => ['required','string','max:255','regex:/^[A-Za-z\s]+$/'],
            'telp_hp_ortu'    => ['required','string','regex:/^\d{8,15}$/'],
            'alamat'          => ['required','string','max:1000'],
        ], [
            'nama_lengkap.regex'   => 'Nama lengkap hanya boleh berisi huruf dan spasi.',
            'nama_panggilan.regex' => 'Nama panggilan hanya boleh huruf dan spasi.',
            'jenis_kelamin.in'     => 'Pilihan jenis kelamin tidak valid.',
            'asal_sekolah.regex'   => 'Asal sekolah mengandung karakter tidak valid.',
            'nama_orangtua.regex'  => 'Nama orang tua hanya boleh berisi huruf dan spasi.',
            'telp_hp_ortu.regex'   => 'Nomor telepon harus berupa angka (8 - 15 digit).',
        ]);

        // Tambahkan user_id (jika ada user login)
        $validatedData['user_id'] = Auth::id();

        // Simpan data
        PendaftarTrial::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('home')->with('status', 'Pendaftaran trial Anda telah berhasil dikirim!');
    }
}
