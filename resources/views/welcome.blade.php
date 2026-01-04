@extends('layouts.main')

@section('title', 'Selamat Datang di Homeschooling Carnation')

@section('content')
    <main class="container">
        

        <section class="dashboard-grid">
        </section>
        
        <section class="cta-section">
            
            <a href="{{ route('daftar.online') }}" class="cta-button btn-red">
                DAFTAR ONLINE
            </a>
            
            <a href="{{ route('daftar.trial') }}" class="cta-button btn-green">
                DAFTAR TRIAL
            </a>

        </section>

    </main>
@endsection