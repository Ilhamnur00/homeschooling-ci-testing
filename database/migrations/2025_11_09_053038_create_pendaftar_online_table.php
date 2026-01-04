<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pendaftar_online', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Link ke Akun Ortu

        // Langkah 1: Data Diri
        $table->string('nama_lengkap');
        $table->string('nama_panggilan')->nullable();
        $table->string('nik', 16)->unique();
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('jenis_kelamin');
        $table->string('agama');
        $table->string('warga_negara');
        $table->string('gol_darah')->nullable();

        // Langkah 2: Akademik & Kontak
        $table->string('sekolah_asal');
        $table->string('nisn')->nullable()->unique();
        $table->string('tingkat');
        $table->string('program_hs');
        $table->text('prestasi')->nullable();
        $table->string('email_ortu'); // Email kontak (bisa beda dari email login)
        $table->string('telp_hp_ortu');
        $table->text('alamat');

        // Langkah 3: Data Ortu
        $table->string('nama_ayah')->nullable();
        $table->string('pekerjaan_ayah')->nullable();
        $table->string('penghasilan_ayah')->nullable();
        $table->string('nama_ibu');
        $table->string('pekerjaan_ibu')->nullable();
        $table->string('penghasilan_ibu')->nullable();
        $table->string('nama_wali')->nullable();
        $table->string('pekerjaan_wali')->nullable();

        // Langkah 4: Berkas
        $table->string('file_kk_ktp'); // Simpan path filenya
        $table->string('file_ijazah'); // Simpan path filenya

        // Lain-lain
        $table->string('status')->default('Baru');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar_online');
    }
};
