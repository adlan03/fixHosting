<?php
// config.php — koneksi database & setting global

// ====== PATH & URL BASE ======
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

if (!defined('BASE_URL')) {
    // Bisa di-override via environment atau hardcode
    $envBase = getenv('BASE_URL');
    if (!empty($envBase)) {
        define('BASE_URL', rtrim($envBase, '/') . '/');
    } else {
        // Deteksi otomatis dari request; override secara manual bila perlu.
        $isHttps = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
        $scheme  = $isHttps ? 'https' : 'http';

        // Ketika berjalan di CLI (misal artisan/cron), fallback ke localhost.
        if (isset($_SERVER['HTTP_HOST'])) {
            $host   = $_SERVER['HTTP_HOST'];
            $base   = trim(dirname($_SERVER['SCRIPT_NAME'] ?? '/'), '/\\');
            $prefix = $base === '' ? '' : $base . '/';
            define('BASE_URL', $scheme . '://' . $host . '/' . $prefix);
        } else {
            // Ubah nilai berikut sesuai direktori root proyek saat lokal
            define('BASE_URL', 'http://localhost/fixHosting/');
        }
    }
}

// ====== KONEKSI DATABASE ======
$host = getenv('DB_HOST') ?: "localhost";
$user = getenv('DB_USER') ?: "root";
$pass = getenv('DB_PASS') ?: "";
$db   = getenv('DB_NAME') ?: "db_infaq";

$mysqli = @new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    http_response_code(500);
    die(
        "Koneksi database gagal. Cek kredensial di config/config.php atau environment DB_*. " .
        "Error: " . $mysqli->connect_error
    );
}

$mysqli->set_charset('utf8mb4');
