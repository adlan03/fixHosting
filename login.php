<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Aplikasi Zakat</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/login.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <!-- Bagian kiri -->
        <section class="left-box">
            <h1>Selamat Datang di<br><span>Pengelolaan Zakat</span></h1>
            <!-- <img src="assets/images/masjid.png" alt="Gambar Islami"> -->
            <div class="ketupat"></div>
            <div class="ketupat ketupat2"></div>
        </section>

        <!-- Bagian kanan (form login) -->
        <section class="login-box">
            <h2>Login Aplikasi</h2>
            <?php if (!empty($_SESSION['login_error'])): ?>
                <div class="card" style="background:#fff3cd;color:#856404;margin-bottom:12px;">
                    <?= htmlspecialchars($_SESSION['login_error']); ?>
                </div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>

            <form method="post" action="index.php?page=ceklogin">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <input type="submit" value="Login">
            </form>
            <div class="user_masyarakat">
                <label for="masyarakat">Lihat Data Sebagai Masyarakat</label>
                <button type="button" onclick="window.location.href='index.php?page=masyarakat'">Klik Ini</button>
            </div>

        </section>
    </div>
</body>

</html>