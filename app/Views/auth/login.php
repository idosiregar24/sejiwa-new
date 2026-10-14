<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Eksternal -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- left-panel -->
    <?= $this->include('layouts/left-panel') ?>

    <!-- Panel Kanan: Formulir Login -->
    <div class="right-panel">
        <div class="form-content">
            <!-- Judul dan Subjudul -->
            <h1 class="form-title">Login</h1>
            <p class="form-subtitle">Silahkan Masukkan Email/No HP dan Kata Sandi Anda!</p>


            <!-- Alert Error / Sukses -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            
    
    <form action="<?= base_url('login') ?>" method="post">
                <!-- Email / No HP -->
                <div class="form-group">
                    <label for="email" class="label-text">Email/No HP <span class="required">*</span></label>
                    <input id="email" type="text" name="email" placeholder="Masukkan Email/No HP" required class="input-field">
                </div>

                <!-- Kata Sandi -->
                <div class="form-group">
                    <label for="password" class="label-text">Kata Sandi <span class="required">*</span></label>
                    <input id="password" type="password" name="password" placeholder="Masukkan Kata Sandi" required class="input-field">
                </div><br>

                <!-- Ingat Saya & Lupa Kata Sandi -->
                <div class="options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        Ingat Saya
                    </label>
                    <a href="#" class="forgot-password-link">Lupa Kata Sandi?</a>
                </div>

                <!-- Tombol Login -->
                <button type="submit" class="submit-button">Login</button>
            </form>

            <p class="register-text">Belum Punya Akun? <a href="/register" class="register-link">Silahkan Daftar</a></p>

            <!-- Opsi Login Lain -->
            <div class="divider">
                <span>Atau masuk dengan</span>
            </div>

            <div class="social-buttons">
                <button class="social-button">
                    <img src="https://www.google.com/favicon.ico" alt="Google icon">
                    <span>Google</span>
                </button>
            </div>
            <div class="social-buttons">
                <button class="social-button">
                    <img src="https://www.svgrepo.com/show/69341/apple-logo.svg" alt="Google icon">
                    <span>Apple</span>
                </button>
            </div>
        </div>
        <p class="noted-text">Dengan mendaftar. saya menyutujui Syarat & Ketentuan serta Kebijakan Privasi yang tersedia</p>
    </div>
</body>
</html>
