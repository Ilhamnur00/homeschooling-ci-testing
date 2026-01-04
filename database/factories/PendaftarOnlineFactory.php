<?php

namespace Database\Factories;

use App\Models\PendaftarOnline;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PendaftarOnlineFactory extends Factory
{
    protected $model = PendaftarOnline::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama_lengkap' => $this->faker->name(),
            'nama_panggilan' => $this->faker->firstName(),
            'nik' => $this->faker->unique()->numerify('################'),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha']),
            'warga_negara' => 'Indonesia',
            'gol_darah' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'sekolah_asal' => $this->faker->company(),
            'nisn' => $this->faker->unique()->numerify('##########'),
            'tingkat' => $this->faker->randomElement(['SD', 'SMP', 'SMA']),
            'program_hs' => $this->faker->randomElement(['Reguler', 'Intensif']),
            'prestasi' => $this->faker->sentence(),
            'email_ortu' => $this->faker->safeEmail(),
            'telp_hp_ortu' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'nama_ayah' => $this->faker->name('male'),
            'pekerjaan_ayah' => $this->faker->jobTitle(),
            'penghasilan_ayah' => '5-10 juta',
            'nama_ibu' => $this->faker->name('female'),
            'pekerjaan_ibu' => $this->faker->jobTitle(),
            'penghasilan_ibu' => '5-10 juta',
            'nama_wali' => $this->faker->name(),
            'pekerjaan_wali' => $this->faker->jobTitle(),
            'file_kk_ktp' => 'public/berkas_pendaftaran/kkktp_dummy.jpg',
            'file_ijazah' => 'public/berkas_pendaftaran/ijazah_dummy.jpg',
        ];
    }
}
