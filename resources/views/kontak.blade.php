@extends('layouts.main')

@section('title', 'Kontak Kami - Homeschooling Carnation')

@section('content')
<style>
    /* CSS Kontak */
    .contact-main { max-width: 700px; margin: 3rem auto; padding: 0 1.5rem; text-align: center; width: 100%; flex-grow: 1; }
    
    .section-title-contact { 
        font-family: 'Times New Roman', serif; font-size: 1.8rem; letter-spacing: 2px; 
        color: #000; margin-bottom: 1.5rem; margin-top: 2rem; text-transform: uppercase; 
    }
    
    .button-group-contact { display: flex; flex-direction: column; gap: 15px; margin-bottom: 3rem; }
    
    .contact-btn {
        display: flex; align-items: center; justify-content: center; width: 100%; padding: 15px 20px;
        border-radius: 10px; text-decoration: none; font-family: 'Courier New', Courier, monospace;
        font-weight: 600; font-size: 1rem; letter-spacing: 3px; transition: transform 0.2s, box-shadow 0.2s; position: relative;
    }
    .contact-btn i { position: absolute; left: 20px; font-size: 1.2rem; }
    .contact-btn:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    
    /* Tombol Biru (Kontak) */
    .btn-blue { background-color: #edf4fc; border: 1px solid #9fbddb; color: #000; }
    .btn-blue:hover { background-color: #dceafc; border-color: #7faad0; }
    
    /* Tombol Cream (Sosmed) */
    .btn-cream { background-color: #fff8e7; border: 1px solid #fadd9e; color: #000; }
    .btn-cream:hover { background-color: #fff0cd; border-color: #eec46e; }
</style>

<div class="contact-main">
    
    <h2 class="section-title-contact">KONTAK KAMI</h2>
    
    <div class="button-group-contact">
        <a href="https://wa.me/6281323717184" target="_blank" class="contact-btn btn-blue">
            <i class="fa-solid fa-phone"></i> W h a t s a p p
        </a>
        <a href="mailto:hscarnation2015@gmail.com" class="contact-btn btn-blue">
            <i class="fa-solid fa-envelope"></i> G m a i l
        </a>
    </div>

    <h2 class="section-title-contact">SOSIAL MEDIA KAMI</h2>
    
    <div class="button-group-contact">
        <a href="https://www.instagram.com/homeschooling_carnationcrb" target="_blank" class="contact-btn btn-cream">
            <i class="fa-brands fa-instagram"></i> I n s t a g r a m
        </a>
        <a href="https://www.tiktok.com/@homeschoolingcarn" target="_blank" class="contact-btn btn-cream">
            <i class="fa-brands fa-tiktok"></i> T i k t o k
        </a>
        <a href="https://www.youtube.com/@homeschoolingcarnationcire1255" target="_blank" class="contact-btn btn-cream">
            <i class="fa-brands fa-youtube"></i> Y o u t u b e
        </a>
    </div>

</div>
@endsection