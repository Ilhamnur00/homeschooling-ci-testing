<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <title>@yield('title', 'Homeschooling Carnation')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Pacifico&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ==========================================================
           🔥 GLOBAL FIX — HAPUS GARIS BIRU + TAMPILKAN GRADIENT
        ========================================================== */

        /* Hapus semua background-image yang berasal dari app.css */
        * {
            background-image: none !important;
        }

        /* Body pakai gradient lembut seperti hero */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(105deg, #fff0f0 0%, #fff5f5 40%, #f0f4ff 100%) !important;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Main & Container transparan, biar efek gradient dari body terlihat */
        main,
        .container {
            background-color: transparent !important;
        }

        /* Hero-banner tetap punya gradient sendiri */
        .hero-banner {
            background: linear-gradient(105deg, #fff0f0 0%, #fff5f5 40%, #f0f4ff 100%) !important;
        }


        /* ==========================================================
           🔰 GLOBAL STYLE NORMAL (TIDAK DIUBAH)
        ========================================================== */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        /* --- HEADER --- */
        .top-header {
            background-color: #d11e1f; color: #ffffff; padding: 1rem 1.5rem;
            display: flex; align-items: center; position: relative;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); border-bottom: 5px solid #a81819;
            flex-wrap: wrap;
        }
        .top-header .logo { width: 55px; height: 55px; object-fit: contain; z-index: 2; }
        .top-header .header-content { flex: 1; text-align: center; padding: 0 1rem; }
        .top-header h3 { font-size: 0.8rem; font-weight: 400; margin-bottom: 2px; }
        .top-header h2 { font-family: 'Oswald', sans-serif; font-size: 1.4rem; font-weight: 700; line-height: 1.2; }
        .top-header .tagline { font-family: 'Pacifico', cursive; font-size: 0.9rem; margin-top: 5px; }

        /* --- NAVBAR --- */
        .navbar {
            background-color: #ffffff; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky; top: 0; z-index: 100;
            padding: 0 1rem;
        }
        .nav-links { 
            display: flex; justify-content: center; align-items: center; 
            overflow-x: auto; white-space: nowrap;
            padding: 0.8rem 0;
            -webkit-overflow-scrolling: touch;
        }
        .nav-links a {
            text-decoration: none; color: #222; font-weight: 600; font-size: 0.95rem;
            padding: 0.5rem 1rem; border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }
        .nav-links a:hover, .nav-links a.active {
            color: #d11e1f; border-bottom-color: #d11e1f;
        }

        /* --- FOOTER --- */
        .main-footer {
            background-color: #ffffff; color: #333; padding: 3rem 1.5rem;
            border-top: 5px solid #d11e1f; font-size: 0.9rem; margin-top: auto;
        }
        .footer-content {
            max-width: 1100px; margin: 0 auto; display: flex;
            justify-content: space-between; gap: 2rem; flex-wrap: wrap;
        }
        .footer-col { flex: 1 1 250px; }
        .footer-col h3 {
            font-family: 'Poppins', sans-serif; font-size: 1.1rem; font-weight: 700;
            margin-bottom: 1.2rem; text-transform: uppercase; color: #333;
        }
        .footer-col.homeschooling h3 { color: #d11e1f; }

        .footer-col ul { list-style: none; padding: 0; }
        .footer-col ul li { margin-bottom: 0.8rem; }
        .footer-col a { text-decoration: none; color: #555; transition: 0.2s; }

        .footer-logo-kurikulum { display: flex; align-items: center; margin-bottom: 1rem; }
        .footer-logo-kurikulum img { height: 40px; margin-right: 15px; }

        .alamat-utama {
            border: 1px solid #1e90ff; background-color: #f0f8ff;
            padding: 15px; border-radius: 8px; margin-bottom: 15px;
        }
        .alamat-utama i, .footer-col i { color: #1e90ff; margin-right: 10px; }

        .copyright {
            max-width: 1100px; margin: 2rem auto 0; text-align: center;
            padding-top: 1rem; border-top: 1px dashed #ccc; color: #777; font-size: 0.85rem;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .top-header { flex-direction: column; text-align: center; padding: 1rem; gap: 10px; }
            .top-header .header-content { width: 100%; padding: 0; }
            .top-header h2 { font-size: 1.2rem; }

            .navbar { padding: 0; }
            .nav-links { justify-content: flex-start; padding: 0.8rem 1rem; }
            .nav-links a { font-size: 0.85rem; padding: 0.5rem 0.8rem; }

            .footer-content { flex-direction: column; gap: 2rem; }
            .footer-col { width: 100%; text-align: center; }
            .footer-logo-kurikulum { justify-content: center; }
        }
    </style>
</head>
<body>

    <header>
        <div class="top-header">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/Logo HSCC Genap - Copy.png') }}" alt="Logo HSCC" class="logo">
            </a>
            <div class="header-content">
                <h3>SELAMAT DATANG DI WEBSITE</h3> 
                <h2>HOMESCHOOLING CARNATION CIREBON</h2>
                <p class="tagline">"Menyenangkan, Cerdas, dan Sukses"</p>
            </div>
        </div>
    </header>

    <nav class="navbar">
        <div class="nav-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Tentang</a>
            <a href="https://homeschoolingcarnation.sch.id/ebook/" target="_blank">E-book</a>
            <a href="{{ route('pendaftaran.menu') }}" class="{{ request()->routeIs('pendaftaran.*') || request()->routeIs('daftar.*') ? 'active' : '' }}">Pendaftaran</a>
            <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
            
            @auth
                <div style="display: flex; align-items: center; gap: 10px; margin-left: 10px;">
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" style="background: white; border: 1px solid #d11e1f; color: #d11e1f; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" style="color: #4A90E2; font-weight: bold;">Login</a>
            @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-col homeschooling">
                <div class="footer-logo-kurikulum">
                    <img src="{{ asset('images/Logo HSCC Genap - Copy.png') }}" alt="Logo HSCC">
                    <img src="{{ asset('images/kurikulum merdeka.png') }}" alt="Kurikulum Merdeka">
                </div>
                <h3>HOMESCHOOLING CARNATION CIREBON</h3>

                <div class="alamat-utama">
                    <ul>
                        <li><i class="fa-solid fa-location-dot"></i> <span>HSCC 1, Jl. Ciremai Raya No. E 12 Perumnas, Cirebon.</span></li>
                    </ul>
                </div>

                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> <span>HSCC 2, Ruko Berry Green No. 21, CSB Mall.</span></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h3>PINTASAN</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('pendaftaran.menu') }}">Info Pendaftaran</a></li>
                    <li><a href="{{ route('kontak') }}">Hubungi Kami</a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h3>IKUTI KAMI</h3>
                <ul class="social-links" style="display:flex; gap:15px; font-size:1.5rem;">
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="copyright">
            &copy; 2025 Homeschooling Carnation Cirebon. All Rights Reserved.
        </div>
    </footer>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
    <script>
        var botmanWidget = {
            aboutText: 'HS Carnation',
            introMessage: "Halo! 👋 Ada yang bisa kami bantu?",
            title: 'Bantuan',
            mainColor: '#d11e1f',
            bubbleBackground: '#d11e1f',
            headerTextColor: '#fff',
            desktopHeight: 450,
            desktopWidth: 320,
            mobileHeight: '90%',
            mobileWidth: '90%'
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js"></script>

</body>
</html>
