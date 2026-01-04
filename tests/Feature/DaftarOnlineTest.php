<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PendaftarOnline;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DaftarOnlineTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test: user login bisa akses halaman daftar online.
     */
    public function test_authenticated_user_can_access_daftar_online_page(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $this->actingAs($user);
        $response = $this->get(route('daftar.online'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('daftar-online');
    }

    /**
     * Test: guest tidak bisa akses halaman daftar online.
     */
    public function test_guest_cannot_access_daftar_online_page(): void
    {
        $response = $this->get(route('daftar.online'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test: user login bisa submit form daftar online.
     */
    public function test_authenticated_user_can_submit_daftar_online_form(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = PendaftarOnline::factory()->make([
            'user_id' => $user->id,
        ])->toArray();

        $data['file_kk_ktp'] = \Illuminate\Http\UploadedFile::fake()->create('kk.pdf', 100);
        $data['file_ijazah'] = \Illuminate\Http\UploadedFile::fake()->create('ijazah.pdf', 100);
        $data['persetujuan'] = true;

        // Act
        $response = $this->post(route('daftar.online'), $data);

        // Assert
        $response->assertRedirect();
        $this->assertDatabaseHas('pendaftar_online', [
            'nama_lengkap' => $data['nama_lengkap'],
            'email_ortu' => $data['email_ortu'],
        ]);
    }

    /**
     * Test: validasi form gagal jika data kosong.
     */
    public function test_validation_fails_with_empty_data(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('daftar.online'), []);

        $response->assertSessionHasErrors([
            'nama_lengkap',
            'email_ortu',
        ]);
    }

    /**
     * Test: user login bisa melihat halaman bukti pendaftaran.
     */
    public function test_authenticated_user_can_view_bukti_pendaftaran(): void
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        $pendaftar = PendaftarOnline::factory()->create([
            'user_id' => $user->id,
        ]);

        // Act
        $response = $this->get(route('daftar.online.bukti', $pendaftar->id));

        // Assert
        $response->assertStatus(200);
        $response->assertViewHas('pendaftar', $pendaftar);
    }
}
