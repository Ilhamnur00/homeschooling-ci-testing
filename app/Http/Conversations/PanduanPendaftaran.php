<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class PanduanPendaftaran extends Conversation
{
    protected $namaUser;

    // 1. Tanya Nama
    public function askNama()
    {
        $this->bot->typesAndWaits(1);
        $this->ask('Halo! 👋 Selamat datang di Homeschooling Carnation Cirebon. Boleh tahu nama Anda/Kakak?', function(Answer $answer) {
            $this->namaUser = $answer->getText();
            
            $this->bot->typesAndWaits(1);
            $this->say("Salam kenal, Kak " . $this->namaUser . "! 😊");
            
            $this->bot->typesAndWaits(1);
            $this->say("Saya asisten virtual HSCC yang siap membantu menjawab pertanyaan seputar sekolah kami.");
            
            $this->askMenuUtama();
        });
    }

    // 2. Menu Utama
    public function askMenuUtama()
    {
        $this->bot->typesAndWaits(1);

        $question = Question::create('Apa yang ingin Kakak ketahui? (Silakan klik tombol di bawah)')
            ->fallback('Maaf, saya tidak mengerti.')
            ->callbackId('menu_utama')
            ->addButtons([
                Button::create('🏫 Profil & Visi Misi')->value('Saya ingin tahu Profil & Visi Misi'),
                Button::create('🎓 Jenjang & Legalitas')->value('Bagaimana info Jenjang & Legalitasnya?'),
                Button::create('📚 Program Belajar')->value('Jelaskan Program Belajar (SaC/LoS)'),
                Button::create('🏆 Fasilitas & Keunggulan')->value('Ada Fasilitas apa saja?'),
                Button::create('💰 Biaya Pendidikan')->value('Berapa rincian Biaya Pendidikannya?'),
                Button::create('📝 Cara & Syarat Daftar')->value('Bagaimana Cara & Syarat Daftarnya?'),
                Button::create('📍 Alamat Lokasi')->value('Dimana Alamat Lokasi sekolahnya?'),
                Button::create('❤️ Konsultasi (ABK/Bullying)')->value('Saya mau Konsultasi (ABK/Bullying)'),
            ]);

        $this->ask($question, function (Answer $answer) {
            $value = $answer->isInteractiveMessageReply() ? $answer->getValue() : $answer->getText();
            
            // Konfirmasi Pilihan (Versi Bersih)
            $this->say("✅ " . $value);

            $text = strtolower($value);

            // LOGIKA PENCOCOKAN
            if (preg_match('/(profil|sejarah|tentang|siapa|visi|misi)/', $text)) {
                $this->infoProfil();
            }
            elseif (preg_match('/(legal|ijazah|resmi|jenjang|sd|smp|sma)/', $text)) {
                $this->infoLegalitas();
            }
            elseif (preg_match('/(metode|belajar|program|sac|los)/', $text)) {
                $this->infoMetode();
            }
            elseif (preg_match('/(fasilitas|gedung|perpus)/', $text)) {
                $this->infoFasilitas();
            }
            elseif (preg_match('/(biaya|harga|bayar|spp)/', $text)) {
                $this->infoBiaya();
            }
            elseif (preg_match('/(alamat|lokasi|dimana)/', $text)) {
                $this->infoAlamat();
            }
            elseif (preg_match('/(daftar|syarat|dokumen)/', $text)) {
                $this->infoDaftar();
            }
            elseif (preg_match('/(curhat|abk|inklusi|bully)/', $text)) {
                $this->infoCurhat();
            }
            elseif (preg_match('/(admin|orang|manusia|wa|whatsapp)/', $text)) {
                $this->infoAdmin();
            }
            else {
                $this->bot->typesAndWaits(1);
                $this->say("Maaf, saya belum mengerti. Silakan pilih menu yang tersedia.");
                $this->askMenuUtama();
            }
        });
    }

    // --- DATABASE JAWABAN (BERSIH TANPA SIMBOL ANEH) ---

    public function infoProfil()
    {
        $this->bot->typesAndWaits(2);
        $this->say("🏫 Profil Homeschooling Carnation (HSCC):");
        
        $this->bot->typesAndWaits(1);
        $this->say("Kami adalah lembaga pendidikan non-formal (PKBM) resmi (NPSN P9945774) di bawah naungan Yayasan Anyelir Daun.");
        
        $this->say("Sejarah: Berdiri sejak 2008 (awal sebagai cabang HS Kak Seto), dan mandiri sebagai HSCC sejak 2015. Kami adalah homeschooling pertama di Cirebon!");
        
        $this->say("Visi: Terwujudnya generasi cerdas, berkarakter, dan memiliki life skills dalam lingkungan yang ramah.");
        $this->tanyaLagi();
    }

    public function infoLegalitas()
    {
        $this->bot->typesAndWaits(2);
        $this->say("🎓 Jenjang & Legalitas:");
        
        $this->bot->typesAndWaits(1);
        $this->say("Legalitas kami 100% RESMI dan diakui negara (Setara Sekolah Formal). Lulusan bisa lanjut kuliah (PTN/PTS), TNI/Polri, atau kerja.");
        
        $this->say("Jenjang Pendidikan:\n✅ Paket A (Setara SD)\n✅ Paket B (Setara SMP)\n✅ Paket C (Setara SMA - IPA/IPS)");
        
        $this->say("Kami menggunakan Kurikulum Merdeka.");
        $this->tanyaLagi();
    }

    public function infoMetode()
    {
        $this->bot->typesAndWaits(2);
        $this->say("📚 Program & Metode Belajar:");
        
        $this->bot->typesAndWaits(1);
        $this->say("Kami menawarkan fleksibilitas sesuai kebutuhan anak (via asesmen awal):");
        
        $this->say("1. SaC (Study at Class): Belajar di sekolah dengan suasana Homey Class yang nyaman. Rasio siswa kecil (1:10) agar fokus.");
        $this->say("2. LoS (Learning on Site): Tutor datang ke rumah siswa. Jadwal fleksibel 3-4x seminggu.");
            
        $this->say("Pendekatan kami Ramah Anak dan berbasis minat bakat.");
        $this->tanyaLagi();
    }

    public function infoFasilitas()
    {
        $this->bot->typesAndWaits(2);
        $this->say("🏆 Fasilitas HSCC:");
        $this->say("Untuk mendukung kenyamanan belajar, kami menyediakan:\n• Ruang kelas nyaman (Full AC & konsep rumahan)\n• Perpustakaan\n• Fasilitas Olahraga\n• Layanan Konsultasi Psikologi & Minat Bakat (Asesmen Awal)");
        $this->tanyaLagi();
    }

    public function infoBiaya()
    {
        $this->bot->typesAndWaits(2);
        $this->say("💰 Biaya Pendidikan:");
        
        $this->bot->typesAndWaits(1);
        $this->say("Biaya kami terjangkau dan transparan. Sudah termasuk modul pembelajaran.");
        $this->say("• Bisa dicicil bulanan.\n• Ada diskon khusus (misal kakak-adik).");
            
        $this->say('<a href="https://wa.me/6281323717184" target="_blank">📞 Minta Pricelist via WA</a>');
        $this->tanyaLagi();
    }

    public function infoAlamat()
    {
        $this->bot->typesAndWaits(2);
        $this->say("📍 Lokasi Kami:");
        $this->say("1. HSCC 1 (Pusat):\nJl. Ciremai Raya No. E 12, Perumnas Kelurahan Kecapi, Harjamukti, Cirebon.");
        $this->say("2. HSCC 2:\nRuko Berry Green, Komplek CSB Mall No. 21, Cirebon.");
        $this->say("Silakan kunjungi lokasi terdekat yaaa! 😊");
        $this->tanyaLagi();
    }

    public function infoDaftar()
    {
        $this->bot->typesAndWaits(2);
        $this->say("📝 Cara & Syarat Daftar:");
        
        $this->say("Cara Daftar:\n1. Online: Isi formulir di sini 👉 <a href='" . route('daftar.online') . "' target='_blank'>Formulir Pendaftaran</a>\n2. Offline: Datang langsung ke kantor HSCC 1 atau HSCC 2.");
            
        $this->say("Syarat Berkas:\n• Scan/Foto KK & Akta Kelahiran\n• Scan/Foto Ijazah/SKHUN (jika ada)\n• Data diri & Data Orang Tua");

        $this->say("Mau coba gratis dulu? <a href='" . route('daftar.trial') . "' target='_blank'>Daftar Trial Class</a>");
        $this->tanyaLagi();
    }

    public function infoCurhat()
    {
        $this->bot->typesAndWaits(2);
        $this->say("❤️ Layanan Inklusi & Personal:");
        $this->say("Kami menerima siswa dengan berbagai latar belakang:");
        $this->say("• Inklusi (ABK): Hak belajar yang sama dengan pendampingan khusus.\n• Korban Bullying: Lingkungan anti-bullying dan kekeluargaan.\n• Minat Khusus: Atlet/Artis yang butuh waktu fleksibel.");
        $this->tanyaLagi();
    }

    public function infoAdmin()
    {
        $this->bot->typesAndWaits(1);
        $this->say("Baik, silakan lanjut mengobrol dengan Admin manusia kami di WhatsApp:");
        $this->say('<a href="https://wa.me/6281323717184" target="_blank">📞 Chat WhatsApp Admin</a>');
        $this->tanyaLagi();
    }

    // 3. Loop / Tanya Lagi
    public function tanyaLagi()
    {
        $this->bot->typesAndWaits(1);
        // Hapus <br> di sini
        $question = Question::create('Ada lagi yang ingin Kak ' . $this->namaUser . ' tanyakan?')
            ->addButtons([
                Button::create('🔄 Ya, Tanya Lain')->value('Saya mau tanya topik lain'),
                Button::create('❌ Tidak, Cukup')->value('Tidak, sudah cukup'),
            ]);

        $this->ask($question, function (Answer $answer) {
            $value = $answer->isInteractiveMessageReply() ? $answer->getValue() : $answer->getText();
            
            // Konfirmasi pilihan
            $this->say("✅ " . $value);

            $text = strtolower($value);
            if (preg_match('/(ya|mau|lagi|boleh)/', $text)) {
                $this->askMenuUtama();
            } else {
                $this->bot->typesAndWaits(1);
                $this->say("Baik, terima kasih Kak " . $this->namaUser . "! Semoga harimu menyenangkan. 😊");
                $this->say("Jangan ragu untuk menghubungi kami lagi nanti.");
            }
        });
    }

    public function run()
    {
        $this->askNama();
    }
}