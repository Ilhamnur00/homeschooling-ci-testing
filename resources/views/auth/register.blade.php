@extends('layouts.main')

@section('title', 'Daftar Akun Baru')

@section('content')
<style>
    /* CSS Khusus Register (Diambil dari regitser.php) */
    .auth-wrapper {
        display: flex; justify-content: center; align-items: center;
        min-height: 80vh; padding: 2rem 1rem;
    }

    .register-container {
        background-color: #ffffff;
        padding: 2.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px; /* Sedikit lebih lebar dari login */
    }

    .register-container h2 {
        text-align: center; color: #333; margin-bottom: 2rem;
        font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.5rem;
    }

    .input-group { margin-bottom: 1.25rem; }
    .input-group label { display: block; margin-bottom: 0.5rem; color: #555; font-weight: 600; }
    .input-group input {
        width: 100%; padding: 0.75rem; border: 1px solid #ddd;
        border-radius: 5px; font-size: 1rem; font-family: 'Poppins', sans-serif;
    }

    .consent-group { display: flex; align-items: flex-start; margin-top: 1.5rem; margin-bottom: 1.5rem; }
    .consent-group input[type="checkbox"] {
        width: 1.25em; height: 1.25em; margin-top: 0.15em; margin-right: 0.75rem; flex-shrink: 0;
    }
    .consent-group label { font-size: 0.85rem; color: #555; line-height: 1.5; }
    .consent-group label a { color: #4A90E2; text-decoration: none; }
    .consent-group label a:hover { text-decoration: underline; }

    .register-button {
        width: 100%; padding: 0.75rem; border: none; border-radius: 5px;
        background-color: #28a745; /* Warna hijau */
        color: white; font-size: 1rem; font-weight: 600;
        cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .register-button:hover { background-color: #218838; transform: translateY(-2px); }

    .separator { display: flex; align-items: center; text-align: center; color: #aaa; margin: 1.5rem 0; }
    .separator::before, .separator::after { content: ''; flex: 1; border-bottom: 1px solid #ddd; }
    .separator span { padding: 0 0.75rem; font-size: 0.9rem; }

    .google-login-button {
        display: flex; justify-content: center; align-items: center; width: 100%;
        padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;
        background-color: #ffffff; color: #555; font-size: 0.95rem; font-weight: 600;
        cursor: pointer; text-decoration: none; transition: background-color 0.3s ease;
    }
    .google-login-button:hover { background-color: #f9f9f9; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .google-logo { width: 20px; height: 20px; margin-right: 12px; }

    .footer-link { text-align: center; margin-top: 1.5rem; }
    .footer-link a { color: #4A90E2; text-decoration: none; font-size: 0.9rem; font-weight: 600; }
    .footer-link a:hover { text-decoration: underline; }
    
    .error-message { color: #dc3545; font-size: 0.85rem; margin-top: 5px; }
</style>

<div class="auth-wrapper">
    <div class="register-container">
        
        <h2>Buat Akun Homeschooling</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="input-group">
                <label for="nama">Nama Lengkap (Orang Tua/Wali)</label>
                <input type="text" id="nama" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label for="password">Buat Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="konfirmasi_password">Konfirmasi Password</label>
                <input type="password" id="konfirmasi_password" name="password_confirmation" required>
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="consent-group">
                <input type="checkbox" id="persetujuan" name="persetujuan" required>
                <label for="persetujuan">
                    Saya telah membaca dan setuju dengan 
                    <a href="#" onclick="return false;">Syarat & Ketentuan</a> 
                    serta 
                    <a href="#" onclick="return false;">Kebijakan Privasi</a>.
                </label>
            </div>

            <button type="submit" class="register-button">Buat Akun Saya</button>
        </form>
        
        <div class="separator">
            <span>atau daftar dengan</span>
        </div>

        <a href="{{ route('google.login') }}" class="google-login-button">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" class="google-logo">
            Lanjutkan dengan Google
        </a>

        <div class="footer-link">
            <a href="{{ route('login') }}">Sudah punya akun? Masuk di sini</a>
        </div>

    </div>
</div>
@endsection