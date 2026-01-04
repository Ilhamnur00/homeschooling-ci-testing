@extends('layouts.main')

@section('title', 'Login Akun')

@section('content')
<style>
    /* CSS Khusus Login (Diambil dari login.php) */
    .auth-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh; /* Tinggi agar pas di tengah antara header & footer */
        padding: 2rem 1rem;
    }

    .login-container {
        background-color: #ffffff;
        padding: 2.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    .login-container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 2rem;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1.5rem;
    }

    .input-group { margin-bottom: 1.5rem; }
    .input-group label { display: block; margin-bottom: 0.5rem; color: #555; font-weight: 600; }
    .input-group input {
        width: 100%; padding: 0.75rem; border: 1px solid #ddd;
        border-radius: 5px; font-size: 1rem; font-family: 'Poppins', sans-serif;
    }

    .login-button {
        width: 100%; padding: 0.75rem; border: none; border-radius: 5px;
        background-color: #4A90E2; color: white; font-size: 1rem; font-weight: 600;
        cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .login-button:hover { background-color: #357ABD; transform: translateY(-2px); }

    .separator {
        display: flex; align-items: center; text-align: center; color: #aaa; margin: 1.5rem 0;
    }
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

    .links { display: flex; justify-content: space-between; margin-top: 1.5rem; }
    .links a { color: #4A90E2; text-decoration: none; font-size: 0.9rem; }
    .links a:hover { text-decoration: underline; }
    
    .error-message { color: #dc3545; font-size: 0.85rem; margin-top: 5px; }
</style>

<div class="auth-wrapper">
    <div class="login-container">
        
        <h2>📚 Login Akun</h2>

        @if (session('status'))
            <div style="color: green; text-align: center; margin-bottom: 1rem;">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="input-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 1rem; display: flex; align-items: center;">
                <input type="checkbox" id="remember_me" name="remember" style="width: auto; margin-right: 0.5rem;">
                <label for="remember_me" style="margin:0; font-size:0.9rem; color:#555;">Ingat Saya</label>
            </div>

            <button type="submit" class="login-button">Masuk</button>
        </form>

        <div class="separator">
            <span>atau masuk dengan</span>
        </div>

        <a href="{{ route('google.login') }}" class="google-login-button">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" class="google-logo">
            Lanjutkan dengan Google
        </a>

        <div class="links">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Lupa Password?</a>
            @endif
            <a href="{{ route('register') }}">Buat Akun Baru</a>
        </div>

    </div>
</div>
@endsection