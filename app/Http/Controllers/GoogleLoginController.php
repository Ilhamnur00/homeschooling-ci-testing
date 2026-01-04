<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Hash; // Kita tambahkan ini

class GoogleLoginController extends Controller
{
    /**
     * Arahkan pengguna ke halaman autentikasi Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Tangani callback dari Google setelah autentikasi.
     */
    public function handleGoogleCallback()
    {
        try {
            // Ambil data pengguna dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cari pengguna di database kita berdasarkan google_id
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // Jika pengguna sudah ada, langsung loginkan
                Auth::login($user);
                return redirect()->route('home'); // Arahkan ke halaman utama

            } else {
                // Jika pengguna belum ada, kita cek berdasarkan email
                $user = User::where('email', $googleUser->email)->first();

                if ($user) {
                    // Jika email sudah terdaftar (misal: daftar manual)
                    // Update akunnya, tambahkan google_id
                    $user->update(['google_id' => $googleUser->id]);
                } else {
                    // Jika pengguna benar-benar baru, buat akun baru
                    $user = User::create([
                        'google_id' => $googleUser->id,
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'password' => null // Password bisa null karena kita ubah di migration
                    ]);
                }

                // Loginkan pengguna baru tersebut
                Auth::login($user);
                return redirect()->route('home'); // Arahkan ke halaman utama
            }

        } catch (Exception $e) {
            // DEBUG: Tampilkan pesan error yang sebenarnya
            return redirect()->route('login')->with('error', 'DEBUG: ' . $e->getMessage());
        }
    }
}