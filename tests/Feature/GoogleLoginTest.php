<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Mockery;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GoogleLoginTest extends TestCase
{
    use DatabaseTransactions;

    protected function mockGoogleUser($overrides = [])
    {
        $googleUser = new SocialiteUser();
        $googleUser->id = $overrides['id'] ?? '1234567890';
        $googleUser->name = $overrides['name'] ?? 'Test User';
        $googleUser->email = $overrides['email'] ?? 'testuser@example.com';
        $googleUser->avatar = 'https://example.com/avatar.jpg';
        return $googleUser;
    }

    public function test_redirect_to_google_works()
    {
        $response = $this->get('/auth/google');
        $response->assertRedirect();
    }

    public function test_handle_google_callback_creates_new_user()
    {
        // Arrange
        $mockUser = $this->mockGoogleUser();

        $providerMock = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $providerMock->shouldReceive('user')->andReturn($mockUser);
        Socialite::shouldReceive('driver')->with('google')->andReturn($providerMock);

        // Act
        $response = $this->get('/auth/google/callback');

        // Assert
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'google_id' => '1234567890',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
    }

    public function test_handle_google_callback_logs_in_existing_user_with_google_id()
    {
        $user = User::factory()->create([
            'google_id' => '999',
            'email' => 'existing@example.com',
        ]);

        $mockUser = $this->mockGoogleUser([
            'id' => '999',
            'email' => 'existing@example.com',
        ]);

        $providerMock = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $providerMock->shouldReceive('user')->andReturn($mockUser);
        Socialite::shouldReceive('driver')->with('google')->andReturn($providerMock);

        $response = $this->get('/auth/google/callback');

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_handle_google_callback_updates_existing_user_email()
    {
        $user = User::factory()->create([
            'google_id' => null,
            'email' => 'old@example.com',
        ]);

        $mockUser = $this->mockGoogleUser([
            'id' => '321',
            'email' => 'old@example.com',
        ]);

        $providerMock = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $providerMock->shouldReceive('user')->andReturn($mockUser);
        Socialite::shouldReceive('driver')->with('google')->andReturn($providerMock);

        $response = $this->get('/auth/google/callback');

        $this->assertDatabaseHas('users', [
            'email' => 'old@example.com',
            'google_id' => '321',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
