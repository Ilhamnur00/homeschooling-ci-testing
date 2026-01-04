@extends('layouts.main')

@section('title', 'Lupa Password')

@section('content')
<style>
    /* Custom Style Khusus Halaman Auth */
    .auth-wrapper {
        min-height: 70vh; /* Agar footer tidak naik terlalu tinggi */
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem 1rem;
    }

    .auth-card {
        background: #ffffff;
        width: 100%;
        max-width: 450px;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        border-top: 5px solid #d11e1f; /* Aksen Merah HSCC */
        text-align: center;
    }

    .auth-card h2 {
        font-family: 'Oswald', sans-serif;
        color: #d11e1f;
        font-size: 1.8rem;
        margin-bottom: 1rem;
        text-transform: uppercase;
    }

    .auth-desc {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    /* Input Styling */
    .form-group {
        margin-bottom: 1.5rem;
        text-align: left;
    }

    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
        font-size: 0.9rem;
    }

    .form-input {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .form-input:focus {
        border-color: #d11e1f;
        outline: none;
        box-shadow: 0 0 0 3px rgba(209, 30, 31, 0.1);
    }

    /* Tombol */
    .btn-auth {
        display: block;
        width: 100%;
        padding: 0.9rem;
        background-color: #d11e1f;
        color: white;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
        font-family: 'Poppins', sans-serif;
    }

    .btn-auth:hover {
        background-color: #b71c1c;
        transform: translateY(-2px);
    }

    /* Footer Link */
    .auth-footer {
        margin-top: 1.5rem;
        font-size: 0.9rem;
    }

    .auth-footer a {
        color: #d11e1f;
        text-decoration: none;
        font-weight: 600;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }

    /* Error Message */
    .text-error {
        color: #d11e1f;
        font-size: 0.85rem;
        margin-top: 5px;
    }

    /* Success Message */
    .alert-success {
        background-color: #e8f5e9;
        color: #2e7d32;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
        text-align: left;
        border-left: 4px solid #2e7d32;
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2>Lupa Password?</h2>
        
        <p class="auth-desc">
            Jangan khawatir. Masukkan email yang terdaftar, kami akan mengirimkan tautan untuk mereset password Anda.
        </p>

        @if (session('status'))
            <div class="alert-success">
                <i class="fa-solid fa-check-circle"></i> {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-input" 
                       value="{{ old('email') }}" required autofocus placeholder="contoh@email.com">
                @error('email')
                    <div class="text-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-auth">
                Kirim Link Reset Password
            </button>
        </form>
        
        <div class="auth-footer">
            Ingat password Anda? <a href="{{ route('login') }}">Login disini</a>
        </div>
    </div>
</div>
@endsection