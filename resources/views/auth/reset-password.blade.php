@extends('layouts.main')

@section('title', 'Reset Password')

@section('body-class', 'auth-page-body')

@section('content')
<div class="register-container">
    <h2>Atur Password Baru Anda</h2>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="input-group">
            <label for="email">Alamat Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label for="password">Password Baru</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="register-button" style="width: 100%;">
            Reset Password
        </button>
    </form>
</div>
@endsection