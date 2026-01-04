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
    Schema::create('pendaftar_trial', function (Blueprint $table) {
        $table->id();

        // Kolom ini menghubungkan ke tabel 'users'
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        // Semua kolom dari formulir Anda
        $table->string('nama_lengkap');
        $table->string('nama_panggilan')->nullable();
        $table->string('jenis_kelamin');
        $table->string('asal_sekolah');
        $table->string('dari_kelas');
        $table->string('nama_orangtua');
        $table->string('telp_hp_ortu');
        $table->text('alamat');
        $table->string('status')->default('Baru'); // Kolom status untuk Admin

        $table->timestamps(); // Kapan formulir ini dibuat
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar_trial');
    }
};
