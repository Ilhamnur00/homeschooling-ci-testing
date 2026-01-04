<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarTrial extends Model
{
    use HasFactory;

    // Tentukan nama tabelnya secara eksplisit
    protected $table = 'pendaftar_trial';

    // Kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nama_panggilan',
        'jenis_kelamin',
        'asal_sekolah',
        'dari_kelas',
        'nama_orangtua',
        'telp_hp_ortu',
        'alamat',
        'status',
    ];
}