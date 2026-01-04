@extends('layouts.main')

@section('title', 'Tentang Kami - Homeschooling Carnation')

@section('content')
<style>
    /* CSS Khusus Halaman Tentang (Diadaptasi dari rizkyganteng) */
    .hero-banner {
        background: linear-gradient(105deg, #fff0f0 0%, #fff5f5 40%, #f0f4ff 100%);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 4rem 10%;
        min-height: 85vh;
        position: relative;
    }
    .hero-text { flex: 1; max-width: 600px; z-index: 10; padding-right: 20px; }
    .hero-subtitle { font-family: 'Poppins', sans-serif; font-size: 1.1rem; letter-spacing: 5px; color: #3b5d8f; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; }
    .hero-title { font-family: 'Pacifico', cursive; font-size: 3rem; line-height: 1.4; margin-bottom: 1.5rem; color: #333; text-shadow: 2px 2px 0px rgba(255,255,255,0.5); }
    .t-pink { color: #ff6b8b; } .t-blue { color: #4d79ff; } .t-purple { color: #a64dff; }
    .hero-desc { font-family: 'Poppins', sans-serif; font-size: 0.95rem; color: #555; line-height: 1.8; margin-bottom: 2rem; font-style: italic; border-left: 4px solid #d11e1f; padding-left: 15px; }
    .hero-buttons { display: flex; gap: 15px; }
    .btn-daftar-hero { background-color: #a80000; color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; box-shadow: 0 4px 15px rgba(168, 0, 0, 0.3); transition: transform 0.3s; }
    .btn-tentang-hero { background-color: rgba(255,255,255,0.6); border: 2px solid #e0e0e0; color: #555; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s; }
    .btn-daftar-hero:hover, .btn-tentang-hero:hover { transform: translateY(-3px); }
    .hero-image { flex: 1; display: flex; justify-content: flex-end; align-items: flex-end; position: relative; gap: 0; }
    .hero-image img { max-width: 48%; height: auto; max-height: 500px; filter: drop-shadow(10px 10px 20px rgba(0,0,0,0.15)); object-fit: contain; }

    /* Section Styles */
    .about-section h1, .kurikulum-section h1, .legalitas-section h1 { font-family: 'Poppins', sans-serif; font-size: 1.2rem; font-weight: 600; color: #333; margin-top: 3rem; margin-bottom: 1.5rem; }
    .about-block { display: flex; flex-wrap: nowrap; align-items: flex-start; background-color: #e6f0ff; border: 1px solid #cce0ff; border-radius: 8px; padding: 1.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 2rem; }
    .about-block img { width: 350px; height: auto; border-radius: 6px; margin-right: 1.5rem; object-fit: cover; flex-shrink: 0; max-width: 40%; }
    .about-block .img-kurikulum { width: 150px; }
    .about-block p { font-size: 0.95rem; line-height: 1.6; color: #444; flex-grow: 1; }
    
    .visi-misi-block { background-color: #e6f0ff; border: 1px solid #cce0ff; border-radius: 8px; padding: 1.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); position: relative; }
    .visi-misi-block .label { font-family: 'Poppins', sans-serif; font-size: 1.1rem; font-weight: 700; color: #333; text-align: center; margin-bottom: 0.5rem; }
    .visi-text { text-align: center; font-style: italic; color: #555; margin-bottom: 2rem; }
    .misi-list li { font-size: 0.95rem; line-height: 1.8; color: #444; padding-left: 1.5rem; position: relative; list-style: none; }
    .misi-list li::before { content: '•'; color: #333; font-weight: bold; display: inline-block; width: 1em; margin-left: -1em; }

    .program-grid { display: flex; gap: 20px; flex-wrap: nowrap; justify-content: space-between; margin-top: 2rem; }
    .program-card { background-color: #e6f0ff; border: 1px solid #cce0ff; border-radius: 8px; padding: 1.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); flex: 1 1 48%; }
    
    .legalitas-content { display: flex; background-color: #e6f0ff; border: 1px solid #cce0ff; border-radius: 8px; padding: 1.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); align-items: center; }
    .legalitas-list { list-style: none; padding-left: 0; flex: 1; }
    .legalitas-list li::before { content: '✓'; color: #1e90ff; font-weight: bold; display: inline-block; width: 1em; margin-left: -1em; margin-right: 5px; }
    .legalitas-image { width: 250px; height: auto; margin-left: 1.5rem; border-radius: 6px; }

    /* Responsive */
    @media (max-width: 800px) {
        .hero-banner { flex-direction: column-reverse; padding: 2rem 1rem; text-align: center; }
        .hero-image { width: 100%; justify-content: center; }
        .hero-image img { max-width: 45%; }
        .about-block, .legalitas-content { flex-direction: column; }
        .about-block img, .legalitas-image { width: 100%; margin: 0 0 1rem 0; max-width: 100%; }
        .program-grid { flex-direction: column; }
    }
</style>

{{-- Hero Section (Banner) --}}
<section class="hero-banner">
    <div class="hero-text">
        <h4 class="hero-subtitle">OPEN ENROLLMENT</h4>
        <h1 class="hero-title">
            <span class="t-pink">HOME</span> <span class="t-purple">SCHOOLING</span><br>
            <span class="t-pink">2026</span> <span class="t-purple">/</span> <span class="t-blue">2027</span>
        </h1>
        <p class="hero-desc">
            “Mulai dari SD hingga SMA, setiap program dibimbing tutor profesional serta dilengkapi 
            dengan fasilitas terbaik untuk menunjang minat dan bakat siswa.”
        </p>
        <div class="hero-buttons">
            <a href="{{ route('pendaftaran.menu') }}" class="btn-daftar-hero">Pendaftaran</a>
            <a href="#about" class="btn-tentang-hero">Tentang Kami</a>
        </div>
    </div>
    <div class="hero-image">
        <img src="{{ asset('images/open enrollment.png') }}" alt="Siswa Homeschooling">
        <img src="{{ asset('images/open enrollment 2.png') }}" alt="Siswa Homeschooling">
    </div>
</section>

{{-- Konten Utama --}}
<div class="container" id="about">
    
    <section class="about-section">
        <h1>TENTANG HOMESCHOOLING</h1>
        <div class="about-block">
            <img src="{{ asset('images/aktivitas.png') }}" alt="Aktivitas Belajar">
            <p>
                Homeschooling adalah sistem pendidikan di mana anak-anak belajar di rumah dengan bimbingan orang tua atau tutor profesional. Metode ini menawarkan fleksibilitas tinggi dalam penyesuaian kurikulum, jadwal, dan cara belajar sesuai kebutuhan anak. Dengan lingkungan yang nyaman dan dukungan keluarga, homeschooling membantu anak belajar lebih efektif sekaligus mengembangkan kemampuan sosial dan akademis.
            </p>
        </div>
    </section>

    <section class="visi-misi-section">
        <div class="visi-misi-block">
            <h4 class="label">VISI</h4>
            <p class="visi-text">"TERWUJUDNYA GENERASI CERDAS, BERKARAKTER DAN MEMILIKI LIFE SKILLS DALAM LINGKUNGAN PENDIDIKAN YANG RAMAH DAN KONDUSIF."</p>
            <h4 class="label">MISI</h4>
            <ul class="misi-list">
                <li>Mewujudkan peserta didik dengan kemampuan sesuai standar kurikulum merdeka.</li>
                <li>Menumbuhkan peserta didik yang memiliki nilai-nilai budaya disiplin dan berkarakter.</li>
                <li>Mengembangkan potensi keterampilan peserta didik sesuai minat dan bakat.</li>
                <li>Mewujudkan lingkungan belajar dengan konsep Home Sweet Home.</li>
                <li>Menyediakan layanan pendidikan dengan rasio siswa per kelas 1:10.</li>
            </ul>
        </div>
    </section>
    
    <section class="kurikulum-section">
        <h1>KURIKULUM & PENDIDIKAN</h1>
        <div class="about-block">
            <img src="{{ asset('images/kurikulum merdeka.png') }}" alt="Kurikulum Merdeka" class="img-kurikulum">
            <p>
                Sebagai lembaga pendidikan non formal, HSCC menyelenggarakan pendidikan kesetaraan di semua jenjang, mulai dari SD hingga SMA. Kami menawarkan paket A setara SD, paket B setara SMP, dan paket C setara SMA dengan dua pilihan jurusan, yaitu IPA dan IPS.
            </p>
        </div>
        
        <div class="program-pendidikan">
            <div class="program-grid">
                <div class="program-card">
                    <h5>STUDY AT CLASS (SAC)</h5>
                    <p>Siswa belajar bersama di Gedung HSCC setiap Senin–Kamis pukul 08.10–11.30 WIB. Maksimal 10 siswa per kelompok.</p>
                </div>
                <div class="program-card">
                    <h5>LEARNING ON SITE (LOS)</h5>
                    <p>Tutor datang ke rumah dengan jadwal fleksibel sesuai kebutuhan orang tua. Pembelajaran 2–3 kali per minggu.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="legalitas-section">
        <h1>LEGALITAS</h1>
        <div class="legalitas-content">
            <ul class="legalitas-list">
                <li>Sudah masuk ke dalam Dinas Pendidikan Kota Cirebon</li>
                <li>Sudah memiliki NPSN (Nomor Pokok Sekolah Nasional)</li>
                <li>Ijazah sudah diakui</li>
                <li>Terakreditasi BAN-PAUD-PNF</li>
            </ul>
            <img src="{{ asset('images/siswa dengan legalitas.png') }}" alt="Legalitas" class="legalitas-image">
        </div>
    </section>

</div>
@endsection