<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- TAMBAHKAN INI DI ATAS

class PendaftarOnline extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_online'; // Tentukan nama tabel

    // Daftar semua kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'nama_lengkap', 'nama_panggilan', 'nik', 'tempat_lahir', 'tanggal_lahir', 
        'jenis_kelamin', 'agama', 'warga_negara', 'gol_darah',
        'sekolah_asal', 'nisn', 'tingkat', 'program_hs', 'prestasi', 
        'email_ortu', 'telp_hp_ortu', 'alamat',
        'nama_ayah', 'pekerjaan_ayah', 'penghasilan_ayah',
        'nama_ibu', 'pekerjaan_ibu', 'penghasilan_ibu',
        'nama_wali', 'pekerjaan_wali',
        'file_kk_ktp', 'file_ijazah', 'status',
    ];

    // ===========================================
    // == TAMBAHKAN FUNGSI RELASI INI ==
    // ===========================================
    /**
     * Mendapatkan data user (orang tua) yang memiliki pendaftaran ini.
     */
    public function user(): BelongsTo
    {
        // Ini memberitahu Laravel bahwa model ini "dimiliki oleh" (belongsTo)
        // model User, menggunakan foreign key 'user_id'
        return $this->belongsTo(User::class);
    }
    // ===========================================
}