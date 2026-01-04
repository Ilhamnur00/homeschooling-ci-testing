<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PendaftarTrial;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DaftarTrialTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: user login bisa akses halaman daftar trial.
     */
    public function test_authenticated_user_can_access_daftar_trial_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $response = $this->get(route('daftar.trial'));

        $response->assertStatus(200);
        $response->assertViewIs('daftar-trial');
    }

    /**
     * Test: guest tidak bisa akses halaman daftar trial.
     */
    public function test_guest_cannot_access_daftar_trial_page(): void
    {
        $response = $this->get(route('daftar.trial'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test: user login bisa submit formulir trial.
     */
    public function test_authenticated_user_can_submit_daftar_trial_form(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $formData = [
            'nama_lengkap' => 'Budi Santoso',
            'nama_panggilan' => 'Budi',
            'jenis_kelamin' => 'Laki-laki',
            'asal_sekolah' => 'SDN 01 Cirebon',
            'dari_kelas' => '5 SD',
            'nama_orangtua' => 'Sutrisno',
            'telp_hp_ortu' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 123, Cirebon',
        ];

        $response = $this->post(route('daftar.trial.store'), $formData);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('status', 'Pendaftaran trial Anda telah berhasil dikirim!');

        $this->assertDatabaseHas('pendaftar_trial', [
            'nama_lengkap' => 'Budi Santoso',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test: validasi gagal jika data tidak lengkap.
     */
    public function test_validation_fails_with_empty_data(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('daftar.trial.store'), []);

        $response->assertSessionHasErrors([
            'nama_lengkap',
            'jenis_kelamin',
            'asal_sekolah',
            'dari_kelas',
            'nama_orangtua',
            'telp_hp_ortu',
            'alamat',
        ]);
    }
}
