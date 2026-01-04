@extends('layouts.main')

@section('title', 'Formulir Pendaftaran Online')

@section('content')
<style>
    /* CSS FORMULIR ONLINE (TEMA BIRU) */
    .form-wrapper { min-height: 85vh; padding: 4rem 1.5rem; display: flex; justify-content: center; width: 100%; }
    .form-container {
        background: #ffffff; width: 100%; max-width: 850px; padding: 3rem;
        border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border-top: 5px solid #1a5c9a;
        position: relative;
    }
    .form-header { text-align: center; margin-bottom: 2rem; }
    .form-header h2 { font-family: 'Oswald', sans-serif; color: #1a5c9a; font-size: 2rem; margin-bottom: 0.5rem; }
    .form-header p { font-family: 'Poppins', sans-serif; color: #666; font-size: 0.9rem; letter-spacing: 1px; }
    
    .current-time { text-align: center; font-size: 0.85rem; color: #888; margin-bottom: 2rem; font-style: italic; }
    .back-link { display: inline-block; margin-bottom: 1rem; color: #555; text-decoration: none; font-size: 0.9rem; font-weight: 600; }
    .back-link:hover { color: #1a5c9a; }

    /* Progress Bar */
    .progress-bar { display: flex; justify-content: space-between; margin-bottom: 3rem; position: relative; }
    .progress-bar::before { content: ''; position: absolute; top: 18px; left: 0; right: 0; height: 3px; background: #eee; z-index: 0; }
    .progress-step { position: relative; z-index: 1; text-align: center; background: #fff; width: 25%; }
    .step-number { width: 40px; height: 40px; background: #fff; border: 2px solid #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; font-weight: 700; color: #999; transition: 0.3s; }
    
    .progress-step.active .step-number { border-color: #1a5c9a; background: #1a5c9a; color: #fff; box-shadow: 0 0 0 4px #e3f2fd; }
    .progress-step.active span { color: #1a5c9a; font-weight: 600; }
    .progress-step.finished .step-number { border-color: #1a5c9a; background: #fff; color: #1a5c9a; }

    /* Form Styles */
    .form-step { display: none; animation: fadeIn 0.5s; }
    .form-step.active { display: block; }
    .form-step h3 { color: #1a5c9a; margin-bottom: 1.5rem; border-bottom: 1px solid #eee; padding-bottom: 10px; font-family: 'Oswald', sans-serif; }
    
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; } /* Default 2 Kolom */
    .input-group { margin-bottom: 1.5rem; width: 100%; }
    .input-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #444; font-size: 0.9rem; }
    .required { color: #d32f2f; margin-left: 3px; }
    
    .form-control { width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 0.95rem; transition: 0.3s; }
    .form-control:focus { border-color: #1a5c9a; outline: none; }
    
    .input-error { border-color: #d32f2f !important; background: #fff8f8; }
    .client-error { color: #d32f2f; font-size: 0.85rem; margin-top: 5px; display: none; }

    /* Buttons */
    .button-group { display: flex; justify-content: space-between; margin-top: 2rem; border-top: 1px dashed #eee; padding-top: 1.5rem; }
    .btn { padding: 12px 30px; border-radius: 50px; border: none; font-weight: 600; cursor: pointer; transition: 0.3s; font-size: 1rem; }
    .btn-prev { background: #f1f1f1; color: #555; }
    .btn-next { background: #1a5c9a; color: #fff; }
    .btn-submit { background: #28a745; color: #fff; }

    .consent-group { display: flex; align-items: flex-start; gap: 10px; background: #f9f9f9; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; }
    .consent-group input { width: 20px; height: 20px; margin-top: 2px; }

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

    /* --- RESPONSIVE CSS --- */
    @media (max-width: 768px) {
        .form-row { grid-template-columns: 1fr; } /* Jadi 1 Kolom di HP */
        .form-container { padding: 1.5rem; width: 100%; margin: 0; }
        .form-wrapper { padding: 2rem 1rem; }
        .form-header h2 { font-size: 1.5rem; }
        
        /* Tombol tumpuk di HP */
        .button-group { flex-direction: column-reverse; gap: 10px; }
        .btn { width: 100%; padding: 10px; }
        
        /* Sembunyikan teks progress bar di HP */
        .progress-step span { display: none; }
    }
</style>

<div class="form-wrapper">
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('pendaftaran.menu') }}" class="back-link">&lt; Kembali</a>
            <h2>FORMULIR PENDAFTARAN</h2>
            <p>HOMESCHOOLING CARNATION CIREBON</p>
        </div>

        <div class="current-time">
            Hari: {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }} 
            Jam <span id="clock">{{ date('H:i') }}</span> W.I.B
        </div>

        <div class="progress-bar">
            <div class="progress-step active" id="p-step-0"><div class="step-number">1</div><span>Data Diri</span></div>
            <div class="progress-step" id="p-step-1"><div class="step-number">2</div><span>Akademik</span></div>
            <div class="progress-step" id="p-step-2"><div class="step-number">3</div><span>Orang Tua</span></div>
            <div class="progress-step" id="p-step-3"><div class="step-number">4</div><span>Berkas</span></div>
        </div>

        @if ($errors->any())
            <div style="background: #ffebee; color: #c62828; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <strong>Mohon periksa input Anda:</strong>
                <ul style="margin-top:0.5rem; padding-left:1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="onlineForm" action="{{ route('daftar.online.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- STEP 1: DATA DIRI --}}
            <div class="form-step active" id="step-0">
                <h3>Langkah 1: Data Diri Siswa</h3>
                
                <div class="input-group">
                    <label>Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                    <div class="client-error">Wajib diisi</div>
                </div>
                
                <div class="form-row">
                    <div class="input-group">
                        <label>Nama Panggilan</label>
                        <input type="text" name="nama_panggilan" class="form-control" value="{{ old('nama_panggilan') }}">
                    </div>
                    <div class="input-group">
                        <label>NIK (16 Digit) <span class="required">*</span></label>
                        <input type="number" name="nik" class="form-control" value="{{ old('nik') }}" required>
                        <div class="client-error">Wajib diisi</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label>Tempat Lahir <span class="required">*</span></label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
                        <div class="client-error">Wajib diisi</div>
                    </div>
                    <div class="input-group">
                        <label>Tanggal Lahir <span class="required">*</span></label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                        <div class="client-error">Wajib diisi</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label>Jenis Kelamin <span class="required">*</span></label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                        </select>
                        <div class="client-error">Wajib dipilih</div>
                    </div>
                    <div class="input-group">
                        <label>Agama <span class="required">*</span></label>
                        <select name="agama" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="Islam" @selected(old('agama') == 'Islam')>Islam</option>
                            <option value="Kristen" @selected(old('agama') == 'Kristen')>Kristen</option>
                            <option value="Katolik" @selected(old('agama') == 'Katolik')>Katolik</option>
                            <option value="Hindu" @selected(old('agama') == 'Hindu')>Hindu</option>
                            <option value="Buddha" @selected(old('agama') == 'Buddha')>Buddha</option>
                            <option value="Konghucu" @selected(old('agama') == 'Konghucu')>Konghucu</option>
                            <option value="Kepercayaan" @selected(old('agama') == 'Kepercayaan')>Kepercayaan thd Tuhan YME</option>
                        </select>
                        <div class="client-error">Wajib dipilih</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label>Warga Negara <span class="required">*</span></label>
                        <select name="warga_negara" class="form-control" required>
                            <option value="WNI" @selected(old('warga_negara') == 'WNI')>WNI</option>
                            <option value="WNA" @selected(old('warga_negara') == 'WNA')>WNA</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Golongan Darah</label>
                        <select name="gol_darah" class="form-control">
                            <option value="">- Pilih -</option>
                            <option value="O" @selected(old('gol_darah') == 'O')>O</option>
                            <option value="A" @selected(old('gol_darah') == 'A')>A</option>
                            <option value="B" @selected(old('gol_darah') == 'B')>B</option>
                            <option value="AB" @selected(old('gol_darah') == 'AB')>AB</option>
                        </select>
                    </div>
                </div>

                <div class="button-group" style="justify-content: flex-end;">
                    <button type="button" class="btn btn-next" onclick="nextStep(1)">Selanjutnya</button>
                </div>
            </div>

            {{-- STEP 2: AKADEMIK --}}
            <div class="form-step" id="step-1">
                <h3>Langkah 2: Akademik & Kontak</h3>

                <div class="form-row">
                    <div class="input-group">
                        <label>Sekolah Asal <span class="required">*</span></label>
                        <input type="text" name="sekolah_asal" class="form-control" value="{{ old('sekolah_asal') }}" required>
                        <div class="client-error">Wajib diisi</div>
                    </div>
                    <div class="input-group">
                        <label>NISN</label>
                        <input type="number" name="nisn" class="form-control" value="{{ old('nisn') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label>Tingkat <span class="required">*</span></label>
                        <select name="tingkat" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="SD" @selected(old('tingkat') == 'SD')>SD (Paket A)</option>
                            <option value="SMP" @selected(old('tingkat') == 'SMP')>SMP (Paket B)</option>
                            <option value="SMA" @selected(old('tingkat') == 'SMA')>SMA (Paket C)</option>
                        </select>
                        <div class="client-error">Wajib dipilih</div>
                    </div>
                    <div class="input-group">
                        <label>Program Homeschooling <span class="required">*</span></label>
                        <select name="program_hs" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="SaC" @selected(old('program_hs') == 'SaC')>Belajar di Sekolah (SaC)</option>
                            <option value="LoS" @selected(old('program_hs') == 'LoS')>Belajar di Rumah (LoS)</option>
                        </select>
                        <div class="client-error">Wajib dipilih</div>
                    </div>
                </div>

                <div class="input-group">
                    <label>Prestasi Belajar (Opsional)</label>
                    <textarea name="prestasi" class="form-control" rows="2">{{ old('prestasi') }}</textarea>
                </div>

                <hr style="margin:1.5rem 0; border:0; border-top:1px dashed #eee;">

                <div class="form-row">
                    <div class="input-group">
                        <label>Email Ortu <span class="required">*</span></label>
                        <input type="email" name="email_ortu" class="form-control" value="{{ old('email_ortu') }}" required>
                        <div class="client-error">Wajib diisi</div>
                    </div>
                    <div class="input-group">
                        <label>No. HP/WA Ortu <span class="required">*</span></label>
                        <input type="tel" name="telp_hp_ortu" class="form-control" value="{{ old('telp_hp_ortu') }}" required>
                        <div class="client-error">Wajib diisi</div>
                    </div>
                </div>

                <div class="input-group">
                    <label>Alamat Lengkap <span class="required">*</span></label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                    <div class="client-error">Wajib diisi</div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-prev" onclick="prevStep(0)">Sebelumnya</button>
                    <button type="button" class="btn btn-next" onclick="nextStep(2)">Selanjutnya</button>
                </div>
            </div>

            {{-- STEP 3: ORANG TUA --}}
            <div class="form-step" id="step-2">
                <h3>Langkah 3: Data Orang Tua</h3>

                <h4 style="color:#555; margin-bottom:1rem; margin-top:0.5rem; font-weight:600;">Data Ayah</h4>
                <div class="form-row">
                    <div class="input-group">
                        <label>Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}">
                    </div>
                    <div class="input-group">
                        <label>Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah') }}">
                    </div>
                </div>
                <div class="input-group">
                    <label>Penghasilan Ayah</label>
                    <select name="penghasilan_ayah" class="form-control">
                        <option value="">- Pilih Penghasilan -</option>
                        <option value="< Rp. 500.000" @selected(old('penghasilan_ayah') == '< Rp. 500.000')>< Rp. 500.000</option>
                        <option value="Rp. 500.000 - Rp. 999.999" @selected(old('penghasilan_ayah') == 'Rp. 500.000 - Rp. 999.999')>Rp. 500.000 - Rp. 999.999</option>
                        <option value="Rp. 1.000.000 - Rp. 1.999.999" @selected(old('penghasilan_ayah') == 'Rp. 1.000.000 - Rp. 1.999.999')>Rp. 1.000.000 - Rp. 1.999.999</option>
                        <option value="Rp. 2.000.000 - Rp. 4.999.999" @selected(old('penghasilan_ayah') == 'Rp. 2.000.000 - Rp. 4.999.999')>Rp. 2.000.000 - Rp. 4.999.999</option>
                        <option value="Rp. 5.000.000 - Rp. 20.000.000" @selected(old('penghasilan_ayah') == 'Rp. 5.000.000 - Rp. 20.000.000')>Rp. 5.000.000 - Rp. 20.000.000</option>
                        <option value="> Rp. 20.000.000" @selected(old('penghasilan_ayah') == '> Rp. 20.000.000')>> Rp. 20.000.000</option>
                        <option value="Tidak Berpenghasilan" @selected(old('penghasilan_ayah') == 'Tidak Berpenghasilan')>Tidak Berpenghasilan</option>
                    </select>
                </div>

                <h4 style="color:#555; margin-bottom:1rem; margin-top:2rem; font-weight:600; border-top:1px dashed #eee; padding-top:1rem;">Data Ibu</h4>
                <div class="form-row">
                    <div class="input-group">
                        <label>Nama Ibu <span class="required">*</span></label>
                        <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}" required>
                        <div class="client-error">Wajib diisi</div>
                    </div>
                    <div class="input-group">
                        <label>Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu') }}">
                    </div>
                </div>
                <div class="input-group">
                    <label>Penghasilan Ibu</label>
                    <select name="penghasilan_ibu" class="form-control">
                        <option value="">- Pilih Penghasilan -</option>
                        <option value="< Rp. 500.000" @selected(old('penghasilan_ibu') == '< Rp. 500.000')>< Rp. 500.000</option>
                        <option value="Rp. 500.000 - Rp. 999.999" @selected(old('penghasilan_ibu') == 'Rp. 500.000 - Rp. 999.999')>Rp. 500.000 - Rp. 999.999</option>
                        <option value="Rp. 1.000.000 - Rp. 1.999.999" @selected(old('penghasilan_ibu') == 'Rp. 1.000.000 - Rp. 1.999.999')>Rp. 1.000.000 - Rp. 1.999.999</option>
                        <option value="Rp. 2.000.000 - Rp. 4.999.999" @selected(old('penghasilan_ibu') == 'Rp. 2.000.000 - Rp. 4.999.999')>Rp. 2.000.000 - Rp. 4.999.999</option>
                        <option value="Rp. 5.000.000 - Rp. 20.000.000" @selected(old('penghasilan_ibu') == 'Rp. 5.000.000 - Rp. 20.000.000')>Rp. 5.000.000 - Rp. 20.000.000</option>
                        <option value="> Rp. 20.000.000" @selected(old('penghasilan_ibu') == '> Rp. 20.000.000')>> Rp. 20.000.000</option>
                        <option value="Tidak Berpenghasilan" @selected(old('penghasilan_ibu') == 'Tidak Berpenghasilan')>Tidak Berpenghasilan</option>
                    </select>
                </div>

                <h4 style="color:#555; margin-bottom:1rem; margin-top:2rem; font-weight:600; border-top:1px dashed #eee; padding-top:1rem;">Data Wali (Opsional)</h4>
                <div class="form-row">
                    <div class="input-group">
                        <label>Nama Wali</label>
                        <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali') }}">
                    </div>
                    <div class="input-group">
                        <label>Pekerjaan Wali</label>
                        <input type="text" name="pekerjaan_wali" class="form-control" value="{{ old('pekerjaan_wali') }}">
                    </div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-prev" onclick="prevStep(1)">Sebelumnya</button>
                    <button type="button" class="btn btn-next" onclick="nextStep(3)">Selanjutnya</button>
                </div>
            </div>

            {{-- STEP 4: BERKAS --}}
            <div class="form-step" id="step-3">
                <h3>Langkah 4: Upload Berkas & Konfirmasi</h3>

                <div style="background: #f8faff; padding: 1.5rem; border-radius: 8px; border: 1px solid #dbeafe; margin-bottom: 2rem;">
                    <div class="input-group">
                        <label>Upload KK & KTP (PDF/JPG, Max 2MB) <span class="required">*</span></label>
                        <input type="file" name="file_kk_ktp" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                        <div class="client-error">Wajib diupload</div>
                    </div>
                    <div class="input-group">
                        <label>Upload Ijazah Terakhir (PDF/JPG, Max 2MB) <span class="required">*</span></label>
                        <input type="file" name="file_ijazah" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                        <div class="client-error">Wajib diupload</div>
                    </div>
                </div>

                <div class="input-group">
                    <label style="display: flex; gap: 10px; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="persetujuan" required style="width: 20px; height: 20px; margin-top:3px;">
                        <span style="font-size: 0.95rem; color: #444;">Saya bertanggung jawab atas Data yang Saya kirimkan adalah Benar.</span>
                    </label>
                    <div class="client-error" style="display:none;">Anda harus menyetujui pernyataan ini.</div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-prev" onclick="prevStep(2)">Sebelumnya</button>
                    <button type="submit" class="btn btn-submit">Kirim Pendaftaran</button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    // Ambil step dari session jika ada error
    let currentStep = parseInt("{{ session('active_step', 0) }}");
    showStep(currentStep);

    function showStep(n) {
        let steps = document.querySelectorAll('.form-step');
        let indicators = document.querySelectorAll('.progress-step');
        
        steps.forEach(s => s.classList.remove('active'));
        indicators.forEach(i => i.classList.remove('active', 'finished'));

        document.getElementById('step-' + n).classList.add('active');
        
        for(let i=0; i<=n; i++) {
            if(i < n) indicators[i].classList.add('finished');
            else indicators[i].classList.add('active');
        }
        
        currentStep = n;
        document.querySelector('.form-wrapper').scrollIntoView({behavior: 'smooth'});
    }

    function nextStep(n) {
        let currentDiv = document.getElementById('step-' + currentStep);
        // Selector UPDATED: Menambahkan textarea ke validasi
        let inputs = currentDiv.querySelectorAll('input[required], select[required], textarea[required]');
        let valid = true;

        inputs.forEach(i => {
            const err = i.parentElement.querySelector('.client-error');
            if(!i.value.trim()) { 
                i.style.borderColor = 'red'; 
                if(err) err.style.display = 'block';
                valid = false; 
            }
            else { 
                i.style.borderColor = '#ddd'; 
                if(err) err.style.display = 'none';
            }
        });

        if(valid) showStep(n);
        else alert('Mohon lengkapi semua data wajib yang ditandai merah!');
    }

    function prevStep(n) {
        showStep(n);
    }
</script>
@endsection