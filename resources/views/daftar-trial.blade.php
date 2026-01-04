@extends('layouts.main')

@section('title', 'Formulir Daftar Trial')

@section('content')
<style>
    /* CSS TEMA ORANYE (TRIAL) */
    .form-wrapper { min-height: 85vh; padding: 4rem 1.5rem; display: flex; justify-content: center; width: 100%; }
    .form-container {
        background: #ffffff; width: 100%; max-width: 700px; padding: 3rem;
        border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border-top: 5px solid #f0a500; /* Warna Oranye */
        position: relative;
    }
    .form-header { text-align: center; margin-bottom: 2rem; }
    .form-header h2 { font-family: 'Oswald', sans-serif; color: #f0a500; font-size: 2rem; margin-bottom: 0.5rem; }
    .form-header p { font-family: 'Poppins', sans-serif; color: #666; font-size: 0.9rem; letter-spacing: 1px; }
    
    .current-time { text-align: center; font-size: 0.85rem; color: #888; margin-bottom: 1.5rem; font-style: italic; }
    .back-link { display: inline-block; margin-bottom: 1rem; color: #555; text-decoration: none; font-size: 0.9rem; font-weight: 600; }
    .back-link:hover { color: #f0a500; }

    /* Progress Bar */
    .progress-bar { display: flex; justify-content: center; gap: 40px; margin-bottom: 2.5rem; position: relative; }
    .progress-bar::before { content: ''; position: absolute; top: 18px; left: 20%; right: 20%; height: 2px; background: #eee; z-index: 0; }
    .progress-step { position: relative; z-index: 1; text-align: center; background: #fff; padding: 0 10px; }
    .step-number { width: 35px; height: 35px; background: #fff; border: 2px solid #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; font-weight: 700; color: #999; transition: all 0.3s; }
    .progress-step span { font-size: 0.85rem; color: #999; font-weight: 600; }
    
    .progress-step.active .step-number { border-color: #f0a500; background: #f0a500; color: #fff; box-shadow: 0 0 0 4px #fff3e0; }
    .progress-step.active span { color: #f0a500; }
    .progress-step.finished .step-number { border-color: #f0a500; background: #fff; color: #f0a500; }

    /* Form Inputs */
    .form-step { display: none; animation: fadeIn 0.5s; }
    .form-step.active { display: block; }
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #444; font-size: 0.9rem; }
    .form-label span.required { color: #d32f2f; margin-left: 3px; }

    .form-control { width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 0.95rem; transition: 0.3s; }
    .form-control:focus { border-color: #f0a500; outline: none; }
    .form-control.error { border-color: #d32f2f !important; background-color: #fff8f8; }
    .error-text { color: #d32f2f; font-size: 0.8rem; margin-top: 5px; display: none; }

    /* Buttons */
    .button-group { display: flex; justify-content: space-between; margin-top: 2rem; border-top: 1px dashed #eee; padding-top: 1.5rem; }
    .btn { padding: 12px 30px; border-radius: 50px; border: none; font-weight: 600; cursor: pointer; transition: 0.3s; font-size: 1rem; }
    .btn-prev { background: #f1f1f1; color: #555; }
    .btn-next { background: #f0a500; color: #fff; }
    .btn-submit { background: #28a745; color: #fff; }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* --- RESPONSIVE CSS --- */
    @media (max-width: 768px) {
        .form-wrapper { padding: 2rem 1rem; }
        .form-container { padding: 1.5rem; margin: 0; width: 100%; }
        .form-header h2 { font-size: 1.5rem; }
        .button-group { flex-direction: column-reverse; gap: 10px; }
        .btn { width: 100%; padding: 10px; }
        .progress-bar { gap: 10px; } /* Jarak antar step lebih kecil di HP */
        .progress-bar::before { left: 10%; right: 10%; }
    }
</style>

<div class="form-wrapper">
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('pendaftaran.menu') }}" class="back-link">&lt; Kembali</a>
            <h2>DAFTAR TRIAL</h2>
            <p>HOMESCHOOLING CARNATION CIREBON</p>
        </div>

        <div class="current-time">
            Hari: {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }} 
        </div>

        <div class="progress-bar">
            <div class="progress-step active" id="indicator-1"><div class="step-number">1</div><span>Data Siswa</span></div>
            <div class="progress-step" id="indicator-2"><div class="step-number">2</div><span>Data Ortu</span></div>
        </div>

        {{-- Tampilkan Error dari Controller jika ada --}}
        @if ($errors->any())
            <div style="background: #ffebee; color: #c62828; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="trialForm" action="{{ route('daftar.trial.store') }}" method="POST">
            @csrf

            <div class="form-step active" id="step-1">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required placeholder="Masukkan Nama Lengkap">
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Panggilan</label>
                    <input type="text" name="nama_panggilan" class="form-control" value="{{ old('nama_panggilan') }}" placeholder="Nama Panggilan">
                </div>

                <div class="form-group">
                    <label class="form-label">Jenis Kelamin <span class="required">*</span></label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">- Pilih -</option>
                        <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Asal Sekolah <span class="required">*</span></label>
                    <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah') }}" required placeholder="Nama Sekolah Sebelumnya">
                </div>

                <div class="form-group">
                    <label class="form-label">Dari Kelas <span class="required">*</span></label>
                    <select name="dari_kelas" class="form-control" required>
                        <option value="">- Pilih Kelas -</option>
                        @foreach(['SD-1', 'SD-2', 'SD-3', 'SD-4', 'SD-5', 'SD-6', 'SMP-7', 'SMP-8', 'SMP-9', 'SMA-10', 'SMA-11', 'SMA-12'] as $kelas)
                            <option value="{{ $kelas }}" @selected(old('dari_kelas') == $kelas)>{{ $kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="button-group" style="justify-content: flex-end;">
                    <button type="button" class="btn btn-next" onclick="nextStep()">Selanjutnya</button>
                </div>
            </div>

            <div class="form-step" id="step-2">
                {{-- PERBAIKAN: name="nama_orangtua" (sesuai controller) --}}
                <div class="form-group">
                    <label class="form-label">Nama Orang Tua <span class="required">*</span></label>
                    <input type="text" name="nama_orangtua" class="form-control" value="{{ old('nama_orangtua') }}" required placeholder="Nama Ayah / Ibu">
                </div>

                {{-- PERBAIKAN: name="telp_hp_ortu" (sesuai controller) --}}
                <div class="form-group">
                    <label class="form-label">Telp./HP (WhatsApp) <span class="required">*</span></label>
                    <input type="tel" name="telp_hp_ortu" class="form-control" value="{{ old('telp_hp_ortu') }}" required placeholder="Contoh: 08123456789">
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat Lengkap <span class="required">*</span></label>
                    <textarea name="alamat" class="form-control" rows="4" required placeholder="Jalan, RT/RW, Kelurahan...">{{ old('alamat') }}</textarea>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-prev" onclick="prevStep()">Sebelumnya</button>
                    <button type="submit" class="btn btn-submit">Daftar</button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    let currentStep = 1;

    function nextStep() {
        const step1Div = document.getElementById('step-1');
        const inputs = step1Div.querySelectorAll('input[required], select[required]');
        let valid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.style.borderColor = 'red';
                valid = false;
            } else {
                input.style.borderColor = '#ddd';
            }
        });

        if (valid) {
            currentStep = 2;
            updateView();
        } else {
            alert("Harap lengkapi semua kolom wajib diisi (*)");
        }
    }

    function prevStep() {
        currentStep = 1;
        updateView();
    }

    function updateView() {
        document.getElementById('step-1').classList.toggle('active', currentStep === 1);
        document.getElementById('step-2').classList.toggle('active', currentStep === 2);
        
        const ind1 = document.getElementById('indicator-1');
        const ind2 = document.getElementById('indicator-2');

        if (currentStep === 1) {
            ind1.classList.add('active'); 
            ind2.classList.remove('active');
        } else {
            ind1.classList.remove('active');
            ind2.classList.add('active');
        }
        
        document.querySelector('.form-container').scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection