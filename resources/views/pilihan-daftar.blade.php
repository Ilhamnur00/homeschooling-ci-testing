@extends('layouts.main')

@section('title', 'Pendaftaran - Homeschooling Carnation')

@section('content')
<style>
    /* Wrapper Utama agar posisi di tengah & responsif */
    .pendaftaran-wrapper {
        display: flex; 
        justify-content: center; 
        align-items: center; 
        min-height: 70vh; /* Tinggi minimal agar footer tidak naik */
        padding: 4rem 1.5rem;
        background-color: transparent; /* Ikut warna background body */
    }

    /* Container Grid Kartu */
    .cards-container {
        display: flex; 
        gap: 50px; /* Jarak antar kartu */
        flex-wrap: wrap; 
        justify-content: center; 
        width: 100%; 
        max-width: 1000px;
    }
    
    /* Style Dasar Kartu */
    .daftar-card {
        flex: 1; 
        min-width: 300px; 
        max-width: 450px;
        background: #ffffff; 
        padding: 3rem 2.5rem;
        border-radius: 20px; 
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); /* Bayangan lembut */
        display: flex; 
        flex-direction: column; 
        justify-content: space-between;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    /* Efek Hover Kartu */
    .daftar-card:hover { 
        transform: translateY(-10px); 
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }
    
    /* Typography di dalam Kartu */
    .daftar-card p {
        font-family: 'Poppins', sans-serif;
        color: #555; 
        margin-bottom: 2.5rem; 
        font-size: 1.1rem; 
        line-height: 1.8;
    }
    
    /* --- KARTU BIRU (DAFTAR ONLINE) --- */
    .card-blue { 
        border: 3px solid #1a5c9a; /* Border Biru Tebal */
    }
    .card-blue span { 
        color: #1a5c9a; 
        font-weight: 700; 
        font-size: 1.2rem;
    }
    .btn-blue { 
        background-color: #1a5c9a; 
        color: white; 
        padding: 15px 40px; 
        border-radius: 50px; 
        text-decoration: none; 
        font-weight: 700; 
        font-size: 1rem;
        display: inline-block; 
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(26, 92, 154, 0.3);
    }
    .btn-blue:hover { 
        background-color: #144a7d; 
        transform: scale(1.05);
    }

    /* --- KARTU ORANYE (DAFTAR TRIAL) --- */
    .card-orange { 
        border: 3px solid #f0a500; /* Border Oranye Tebal */
    }
    .card-orange span { 
        color: #f0a500; 
        font-weight: 700; 
        font-size: 1.2rem;
    }
    .btn-orange { 
        background-color: #f0a500; 
        color: white; 
        padding: 15px 40px; 
        border-radius: 50px; 
        text-decoration: none; 
        font-weight: 700; 
        font-size: 1rem;
        display: inline-block; 
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(240, 165, 0, 0.3);
    }
    .btn-orange:hover { 
        background-color: #d69300; 
        transform: scale(1.05);
    }

    /* Responsif untuk HP */
    @media (max-width: 768px) {
        .cards-container { 
            flex-direction: column; 
            align-items: center; 
            gap: 30px; 
        }
        .daftar-card { 
            width: 100%; 
            max-width: 100%; 
        }
    }
</style>

<div class="pendaftaran-wrapper">
    <div class="cards-container">
        
        <div class="daftar-card card-blue">
            <p>
                Daftar disini apabila kamu <span>sudah yakin</span> untuk menjadi bagian dari Homeschooling Carnation Cirebon! Jangan lupa siapin berkasnya ya ^-^
            </p>
            {{-- Tombol mengarah ke route daftar.online --}}
            <div>
                <a href="{{ route('daftar.online') }}" class="btn-blue">Daftar Online</a>
            </div>
        </div>

        <div class="daftar-card card-orange">
            <p>
                Mau <span>nyoba-nyoba</span> liat contoh form pendaftarannya kayak apa? Klik tombol dibawah yaaa :)
            </p>
            {{-- Tombol mengarah ke route daftar.trial --}}
            <div>
                <a href="{{ route('daftar.trial') }}" class="btn-orange">Daftar Trial</a>
            </div>
        </div>

    </div>
</div>
@endsection