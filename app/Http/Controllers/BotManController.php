<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use BotMan\BotMan\Interfaces\CacheInterface;
use App\Http\Conversations\PanduanPendaftaran; // <-- Pastikan ini ada

class BotManController extends Controller
{
    public function handle()
    {
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

        $config = [
            'conversation_cache_time' => 40,
            'user_cache_time' => 30,
        ];

        // Gunakan LaravelCache agar memori Multi-turn jalan
        $botman = BotManFactory::create($config, new LaravelCache());

        // Pemicu Percakapan Multi-turn
        $botman->hears('.*(halo|hi|hai|hello|mulai|start|menu|bantuan).*', function (BotMan $bot) {
            $bot->startConversation(new PanduanPendaftaran());
        });

        // Fallback
        $botman->fallback(function($bot) {
            $bot->reply("Maaf, saya kurang mengerti. Coba ketik **'halo'** untuk memulai percakapan bantuan.");
        });

        $botman->listen();
    }
}

// KELAS CACHE (JANGAN DIHAPUS)
class LaravelCache implements CacheInterface
{
    public function has($key) { return Cache::has($key); }
    public function get($key, $default = null) { return Cache::get($key, $default); }
    public function put($key, $value, $minutes) { Cache::put($key, $value, now()->addMinutes($minutes)); }
    public function pull($key, $default = null) { return Cache::pull($key, $default); }
}