@extends('layouts.main')

@section('title', 'Tentang Kami - Homeschooling Carnation')

@section('content')
<style>
    /* HERO BANNER */
    .hero-banner {
        background: linear-gradient(105deg, #fff0f0 0%, #fff5f5 40%, #f0f4ff 100%);
        padding: 4rem 10%; min-height: 85vh; display: flex; align-items: center;
        justify-content: space-between; position: relative;
    }
    .hero-text { flex: 1; max-width: 600px; padding-right: 20px; z-index: 10; }
    .hero-subtitle { font-family: 'Poppins', sans-serif; font-size: 1.1rem; letter-spacing: 5px; color: #3b5d8f; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; }
    .hero-title { font-family: 'Pacifico', cursive; font-size: 3rem; line-height: 1.4; margin-bottom: 1.5rem; color: #333; text-shadow: 2px 2px 0px rgba(255,255,255,0.5); }
    .t-pink { color: #ff6b8b; } .t-purple { color: #a64dff; } .t-blue { color: #4d79ff; }
    .hero-desc { font-family: 'Poppins', sans-serif; font-size: 0.95rem; color: #555; line-height: 1.8; margin-bottom: 2rem; padding-left: 1rem; border-left: 4px solid #d11e1f; font-style: italic; }
    
    .hero-buttons { display: flex; gap: 15px; }
    .btn-daftar-hero { background-color: #a80000; color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; box-shadow: 0 4px 15px rgba(168, 0, 0, 0.3); transition: transform 0.3s; }
    .btn-tentang-hero { background-color: rgba(255,255,255,0.6); border: 2px solid #e0e0e0; color: #555; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s; }
    .btn-daftar-hero:hover, .btn-tentang-hero:hover { transform: translateY(-3px); }

    .hero-image { flex: 1; display: flex; justify-content: flex-end; align-items: flex-end; }
    .hero-image img { max-width: 48%; height: auto; max-height: 500px; filter: drop-shadow(10px 10px 20px rgba(0,0,0,0.15)); object-fit: contain; }

    /* STYLE KONTEN */
    .container { max-width: 1000px; margin: 2rem auto; padding: 0 1.5rem; }
    .section-title-custom { font-family: 'Poppins', sans-serif; font-size: 1.2rem; font-weight: 600; color: #333; margin-top: 3rem; margin-bottom: 1.5rem; }
    
    .about-block { display: flex; align-items: flex-start; background-color: #e6f0ff; border: 1px solid #cce0ff; border-radius: 8px; padding: 1.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 2rem; gap: 1.5rem; }
    .about-block img { width: 350px; border-radius: 6px; object-fit: cover; max-width: 40%; }
    .about-block p { font-size: 0.95rem; line-height: 1.6; color: #444; flex-grow: 1; }

    .visi-misi-block { background-color: #e6f0ff; border: 1px solid #cce0ff; border-radius: 8px; padding: 1.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center; position: relative; }
    .visi-misi-block .label { font-family: 'Poppins', sans-serif; font-size: 1.1rem; font-weight: 700; color: #333; margin-bottom: 0.5rem; }
    .visi-text { font-style: italic; color: #555; margin-bottom: 2rem; }
    .misi-list { text-align: left; list-style: none; padding-left: 0; }
    .misi-list li { font-size: 0.95rem; line-height: 1.8; color: #444; padding-left: 1.5rem; position: relative; }
    .misi-list li::before { content: '•'; color: #333; font-weight: bold; display: inline-block; width: 1em; margin-left: -1em; }

    .program-grid { display: flex; gap: 20px; justify-content: space-between; margin-top: 1rem; flex-wrap: wrap; }
    .program-card { background-color: #e6f0ff; border: 1px solid #cce0ff; border-radius: 8px; padding: 1.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); flex: 1; min-width: 300px; }
    
    .legalitas-content { display: flex; background-color: #e6f0ff; border: 1px solid #cce0ff; border-radius: 8px; padding: 1.5rem; align-items: center; gap: 1.5rem; }
    .legalitas-list { list-style: none; padding: 0; flex: 1; }
    .legalitas-list li { font-size: 0.95rem; line-height: 2.2; color: #444; }
    .legalitas-list li::before { content: '✓'; color: #1e90ff; font-weight: bold; margin-right: 10px; }
    .legalitas-image { width: 250px; height: auto; border-radius: 6px; }

    .pengajar-grid { background-color: #fff; border: 1px solid #cce0ff; border-radius: 8px; padding: 2rem; display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 1.5rem; justify-items: center; }
    .pengajar-card { text-align: center; }
    .pengajar-card img { width: 80px; height: 80px; border-radius: 50%; border: 3px solid #e6f0ff; object-fit: cover; margin-bottom: 0.5rem; }
    .pengajar-card span { font-size: 0.8rem; font-weight: 600; color: #333; text-transform: uppercase; }

    /* CSS ALUMNI (DARI RIZKYGANTENG) */
    .alumni-section { margin-top: 4rem; }
    .alumni-section h4 { font-family: 'Pacifico', cursive; font-size: 2rem; color: #333; text-align: center; margin-bottom: 2rem; }
    .alumni-grid { display: flex; gap: 20px; overflow-x: auto; padding-bottom: 1rem; justify-content: center; }
    .alumni-card { flex: 0 0 300px; background-color: #ffffff; border: 1px solid #cce0ff; border-radius: 8px; padding: 1rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; min-height: 150px; }
    .alumni-card.large { flex: 0 0 450px; background-color: #e6f0ff; }
    .alumni-info { display: flex; align-items: center; margin-bottom: 0.5rem; }
    .alumni-info img { width: 50px; height: 50px; border-radius: 50%; margin-right: 10px; object-fit: cover; }
    .alumni-name-job span { display: block; font-size: 0.8rem; color: #666; font-weight: 600; }
    .alumni-card p.quote { font-size: 0.9rem; line-height: 1.5; color: #333; font-style: italic; }

    @media (max-width: 800px) {
        .hero-banner { flex-direction: column-reverse; padding: 2rem 1rem; text-align: center; }
        .hero-image { width: 100%; margin-bottom: 2rem; justify-content: center; }
        .hero-image img { max-width: 45%; }
        .about-block, .legalitas-content { flex-direction: column; }
        .about-block img, .legalitas-image { width: 100%; max-width: 100%; }
        .alumni-grid { justify-content: flex-start; padding: 0 1rem; }
    }
</style>

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
        <img src="{{ asset('images/open enrollment.png') }}" alt="Siswa 1">
        <img src="{{ asset('images/open enrollment 2.png') }}" alt="Siswa 2">
    </div>
</section>

<div class="container" id="about">
    
    <h1 class="section-title-custom">TENTANG HOMESCHOOLING</h1>
    <div class="about-block">
        <img src="{{ asset('images/aktivitas.png') }}" alt="Aktivitas Belajar">
        <p>
            Homeschooling adalah sistem pendidikan di mana anak-anak belajar di rumah dengan bimbingan orang tua atau tutor profesional. Metode ini menawarkan fleksibilitas tinggi dalam penyesuaian kurikulum, jadwal, dan cara belajar sesuai kebutuhan anak. Dengan lingkungan yang nyaman dan dukungan keluarga, homeschooling membantu anak belajar lebih efektif sekaligus mengembangkan kemampuan sosial dan akademis.
        </p>
    </div>

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
            <li>Memberikan hak belajar yang sama bagi siswa dengan kondisi berkebutuhan khusus.</li>
        </ul>
    </div>
    
    <h1 class="section-title-custom">KURIKULUM & PENDIDIKAN</h1>
    <div class="about-block">
        <img src="{{ asset('images/kurikulum merdeka.png') }}" alt="Kurikulum Merdeka" class="img-kurikulum" style="width: 150px; align-self:center;">
        <p>
            Sebagai lembaga pendidikan non formal, HSCC menyelenggarakan pendidikan kesetaraan di semua jenjang, mulai dari SD hingga SMA. Kami menawarkan paket A setara SD, paket B setara SMP, dan paket C setara SMA dengan dua pilihan jurusan, yaitu IPA dan IPS. Lulusan HSCC memiliki kesempatan untuk melanjutkan pendidikan ke sekolah formal hingga perguruan tinggi.
        </p>
    </div>
    
    <div style="margin-bottom: 3rem;">
        <h4 class="section-title-custom" style="font-size: 1rem;">PROGRAM PENDIDIKAN HSCC</h4>
        <div class="program-grid">
            <div class="program-card">
                <h5>STUDY AT CLASS (SAC)</h5>
                <p>Program ini memungkinkan siswa belajar bersama di Gedung HSCC setiap Senin–Kamis pukul 08.10–11.30 WIB. Dengan maksimal 10 siswa per kelompok, pembelajaran lebih intensif dan personal.</p>
            </div>
            <div class="program-card">
                <h5>LEARNING ON SITE (LOS)</h5>
                <p>Program ini menyediakan tutor yang datang ke rumah dengan jadwal fleksibel sesuai kebutuhan orang tua. Pembelajaran berlangsung 2–3 kali per minggu.</p>
            </div>
        </div>
    </div>
    
    <h1 class="section-title-custom">LEGALITAS</h1>
    <div class="legalitas-content">
        <ul class="legalitas-list">
            <li>Sudah masuk ke dalam Dinas Pendidikan Kota Cirebon</li>
            <li>Sudah memiliki NPSN (Nomor Pokok Sekolah Nasional)</li>
            <li>Ijazah sudah diakui</li>
            <li>Terakreditasi BAN-PAUD-PNF</li>
        </ul>
        <img src="{{ asset('images/siswa dengan legalitas.png') }}" alt="Legalitas" class="legalitas-image">
    </div>

    <h1 class="section-title-custom">TENAGA PENGAJAR</h1>
    <section class="teachers-section" style="padding: 4rem 1.5rem; background-color: #fff;">
    <div class="container" style="max-width: 1100px; margin: 0 auto; text-align: center;">

        <div class="teachers-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            
            @forelse($pengajars as $pengajar)
                <div class="teacher-card" style="background: #f9f9f9; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: transform 0.3s;">
                    <div style="width: 120px; height: 120px; margin: 0 auto 1rem; border-radius: 50%; overflow: hidden; border: 3px solid #d11e1f;">
                        @if($pengajar->foto)
                            <img src="{{ asset('storage/' . $pengajar->foto) }}" alt="{{ $pengajar->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($pengajar->nama) }}&background=d11e1f&color=fff" style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
                    </div>

                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #333; margin-bottom: 0.5rem;">{{ $pengajar->nama }}</h3>
                    <p style="color: #d11e1f; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.8rem;">{{ $pengajar->jabatan }}</p>
                    
                    @if($pengajar->deskripsi)
                        <p style="font-size: 0.85rem; color: #666; line-height: 1.5;">
                            "{{ $pengajar->deskripsi }}"
                        </p>
                    @endif
                </div>
            @empty
                <p style="width: 100%; text-align: center; color: #777;">Belum ada data pengajar.</p>
            @endforelse

        </div>
    </div>
</section>

    <section class="alumni-section">
        <h4>Apa kata alumni?</h4>
        <div class="alumni-grid">
            <div class="alumni-card">
                <div class="alumni-info">
                    <img src="{{ asset('images/Logo HSCC Genap - Copy.png') }}" alt="Alumni 1">
                    <div class="alumni-name-job">
                        <span>ALUMNI 1</span>
                        <span>Mahasiswa UI</span>
                    </div>
                </div>
                <p class="quote">"Belajar di HSCC sangat fleksibel dan menyenangkan."</p>
            </div>
            
            <div class="alumni-card large">
                <div class="alumni-info">
                    <img src="{{ asset('images/Logo HSCC Genap - Copy.png') }}" alt="Alumni 2">
                    <div class="alumni-name-job">
                        <span>ALUMNI 2</span>
                        <span>Pengusaha Muda</span>
                    </div>
                </div>
                <p class="quote">"Saya bisa mengembangkan bisnis sambil sekolah berkat sistem homeschooling."</p>
            </div>

            <div class="alumni-card">
                <div class="alumni-info">
                    <img src="{{ asset('images/Logo HSCC Genap - Copy.png') }}" alt="Alumni 3">
                    <div class="alumni-name-job">
                        <span>ALUMNI 3</span>
                        <span>Freelancer</span>
                    </div>
                </div>
                <p class="quote">"Guru-gurunya sangat suportif dan ramah."</p>
            </div>
        </div>
    </section>

</div>
@endsection