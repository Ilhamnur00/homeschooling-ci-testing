<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - {{ $pendaftar->nama_lengkap }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11pt; color: #333; }
        .container { width: 100%; margin: 0 auto; }
        
        /* Header Surat */
        .header { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; }
        .header h2 { margin: 5px 0 0; font-size: 14pt; font-weight: bold; color: #d11e1f; }
        .header p { margin: 5px 0 0; font-size: 10pt; }

        .title { text-align: center; font-size: 14pt; font-weight: bold; text-decoration: underline; margin-bottom: 30px; text-transform: uppercase; }

        /* Tabel Data */
        .data-section { margin-bottom: 20px; }
        .data-section h3 { background-color: #eee; padding: 5px; font-size: 12pt; border-bottom: 1px solid #ccc; margin-bottom: 10px; }
        
        table { width: 100%; border-collapse: collapse; }
        td { padding: 5px; vertical-align: top; }
        td:first-child { width: 180px; font-weight: bold; }
        td:nth-child(2) { width: 10px; text-align: center; }

        .footer { margin-top: 50px; text-align: center; font-size: 9pt; font-style: italic; color: #666; border-top: 1px solid #ccc; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Formulir Pendaftaran Siswa Baru</h1>
            <h2>Homeschooling Carnation Cirebon</h2>
            <p>Jl. Ciremai Raya No. E 12 Perumnas, Cirebon | Telp: 0813-2371-7184</p>
        </div>

        <div class="title">Bukti Pendaftaran Online</div>

        <div class="data-section">
            <h3>A. Data Diri Siswa</h3>
            <table>
                <tr><td>Nama Lengkap</td><td>:</td><td>{{ $pendaftar->nama_lengkap }}</td></tr>
                <tr><td>Nama Panggilan</td><td>:</td><td>{{ $pendaftar->nama_panggilan }}</td></tr>
                <tr><td>NIK</td><td>:</td><td>{{ $pendaftar->nik }}</td></tr>
                <tr><td>Tempat, Tgl Lahir</td><td>:</td><td>{{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d F Y') }}</td></tr>
                <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $pendaftar->jenis_kelamin }}</td></tr>
                <tr><td>Agama</td><td>:</td><td>{{ $pendaftar->agama }}</td></tr>
                <tr><td>Warga Negara</td><td>:</td><td>{{ $pendaftar->warga_negara }}</td></tr>
            </table>
        </div>

        <div class="data-section">
            <h3>B. Data Akademik</h3>
            <table>
                <tr><td>Sekolah Asal</td><td>:</td><td>{{ $pendaftar->sekolah_asal }}</td></tr>
                <tr><td>NISN</td><td>:</td><td>{{ $pendaftar->nisn }}</td></tr>
                <tr><td>Tingkat</td><td>:</td><td>{{ $pendaftar->tingkat }}</td></tr>
                <tr><td>Program</td><td>:</td><td>{{ $pendaftar->program_hs }}</td></tr>
            </table>
        </div>

        <div class="data-section">
            <h3>C. Data Orang Tua / Kontak</h3>
            <table>
                <tr><td>Nama Ayah</td><td>:</td><td>{{ $pendaftar->nama_ayah }}</td></tr>
                <tr><td>Nama Ibu</td><td>:</td><td>{{ $pendaftar->nama_ibu }}</td></tr>
                <tr><td>No. HP / WA</td><td>:</td><td>{{ $pendaftar->telp_hp_ortu }}</td></tr>
                <tr><td>Email</td><td>:</td><td>{{ $pendaftar->email_ortu }}</td></tr>
                <tr><td>Alamat</td><td>:</td><td>{{ $pendaftar->alamat }}</td></tr>
            </table>
        </div>

        <div class="footer">
            Dokumen ini diterbitkan secara otomatis pada {{ now()->format('d F Y H:i') }}.<br>
            Harap simpan bukti ini untuk keperluan daftar ulang.
        </div>
    </div>
</body>
</html>