@extends('layouts.main')

@section('title', 'Bukti Pendaftaran Online')

@section('content')
<style>
    /* Wrapper untuk tampilan layar */
    .proof-wrapper {
        padding: 4rem 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #f4f6f9;
        min-height: 85vh;
    }

    /* Area Kertas A4 */
    .printable-area {
        width: 210mm;
        min-height: 297mm;
        background-color: #ffffff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        padding: 20mm;
        box-sizing: border-box;
        margin-bottom: 2rem;
        position: relative;
    }

    /* Styling Konten Surat */
    .header { text-align: center; border-bottom: 3px double #000; padding-bottom: 1rem; margin-bottom: 2rem; }
    .header h1 { margin: 0; font-size: 16pt; font-weight: 700; color: #000; text-transform: uppercase; }
    .header h2 { margin: 5px 0 0; font-size: 14pt; font-weight: 700; color: #d11e1f; }
    
    .document-title { text-align: center; font-size: 14pt; font-weight: 700; text-decoration: underline; margin-bottom: 2rem; text-transform: uppercase; }

    .data-section { margin-bottom: 1.5rem; }
    .data-section h3 { background-color: #eee; padding: 5px 10px; font-size: 11pt; font-weight: 700; margin-bottom: 10px; border-left: 5px solid #d11e1f; }
    
    .data-table { width: 100%; border-collapse: collapse; font-size: 11pt; }
    .data-table td { padding: 6px 10px; vertical-align: top; }
    .data-table td:first-child { width: 35%; font-weight: 600; color: #444; }
    .data-table td:nth-child(2) { width: 2%; } /* Titik dua */
    
    .footer-note { margin-top: 3rem; font-size: 9pt; font-style: italic; color: #666; border-top: 1px solid #ccc; padding-top: 10px; text-align: center; }

    /* Tombol Cetak */
    .btn-print {
        background-color: #1a5c9a; color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; border: none; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: 0.3s;
    }
    .btn-print:hover { background-color: #144a7d; transform: translateY(-2px); }
    .proof-wrapper {
        padding: 4rem 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #f4f6f9;
        min-height: 85vh;
    }

    /* --- PERBAIKAN CSS CETAK (PRINT) --- */
    @media print {
        /* Sembunyikan elemen layout website secara spesifik */
        /* Jangan gunakan 'body * { visibility: hidden }' karena berisiko */
        header, nav, footer, .top-header, .navbar, .main-footer, .btn-print, .back-link { 
            display: none !important; 
        }
        
        /* Reset background dan margin */
        body, .proof-wrapper { 
            background-color: white !important; 
            margin: 0 !important; 
            padding: 0 !important; 
            height: auto !important;
            overflow: visible !important;
        }
        
        /* Pastikan area kertas tampil penuh */
        .printable-area {
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            box-shadow: none !important;
            display: block !important;
        }
        
        /* Paksa text hitam agar jelas */
        * { 
            -webkit-print-color-adjust: exact !important; 
            print-color-adjust: exact !important; /* <--- TAMBAHKAN BARIS INI */
        }
    }
</style>

<div class="proof-wrapper">
    <div style="margin-bottom: 2rem;">
        <button onclick="window.print()" class="btn-print">
            <i class="fa-solid fa-print"></i> Cetak / Simpan PDF
        </button>
    </div>

    <div class="printable-area">
        <header class="header">
            <h1>FORMULIR PENDAFTARAN SISWA BARU</h1>
            <h2>HOMESCHOOLING CARNATION CIREBON</h2>
            <p style="margin: 5px 0 0; font-size: 10pt; color: #000;">Jl. Ciremai Raya No. E 12 Perumnas, Cirebon. | Telp: 0813-2371-7184</p>
        </header>

        <h2 class="document-title">BUKTI PENDAFTARAN ONLINE</h2>

        <section class="data-section">
            <h3>A. DATA DIRI SISWA</h3>
            <table class="data-table">
                <tr><td>Nama Lengkap</td><td>:</td><td>{{ $pendaftar->nama_lengkap }}</td></tr>
                <tr><td>Nama Panggilan</td><td>:</td><td>{{ $pendaftar->nama_panggilan }}</td></tr>
                <tr><td>NIK</td><td>:</td><td>{{ $pendaftar->nik }}</td></tr>
                <tr><td>Tempat, Tgl Lahir</td><td>:</td><td>{{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d F Y') }}</td></tr>
                <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $pendaftar->jenis_kelamin }}</td></tr>
                <tr><td>Agama</td><td>:</td><td>{{ $pendaftar->agama }}</td></tr>
            </table>
        </section>

        <section class="data-section">
            <h3>B. DATA AKADEMIK</h3>
            <table class="data-table">
                <tr><td>Sekolah Asal</td><td>:</td><td>{{ $pendaftar->sekolah_asal }}</td></tr>
                <tr><td>Tingkat</td><td>:</td><td>{{ $pendaftar->tingkat }}</td></tr>
                <tr><td>Program Pilihan</td><td>:</td><td>{{ $pendaftar->program_hs }}</td></tr>
            </table>
        </section>

        <section class="data-section">
            <h3>C. DATA ORANG TUA / WALI</h3>
            <table class="data-table">
                <tr><td>Nama Ayah</td><td>:</td><td>{{ $pendaftar->nama_ayah }}</td></tr>
                <tr><td>Nama Ibu</td><td>:</td><td>{{ $pendaftar->nama_ibu }}</td></tr>
                <tr><td>No. HP / WA</td><td>:</td><td>{{ $pendaftar->telp_hp_ortu }}</td></tr>
                <tr><td>Alamat</td><td>:</td><td>{{ $pendaftar->alamat }}</td></tr>
            </table>
        </section>

        <div class="footer-note">
            <p>Dokumen ini adalah bukti pendaftaran sah yang diterbitkan secara otomatis oleh sistem pada tanggal {{ $pendaftar->created_at->format('d F Y H:i') }}.</p>
            <p>Silakan simpan bukti ini untuk proses verifikasi selanjutnya.</p>
        </div>
    </div>
</div>
@endsection