<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - SEJIWA</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #586166;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 8px;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #b16b8e;
            text-decoration: underline;
        }
        .info-box {
            background-color: #fdf2f7;
            border-left: 4px solid #b16b8e;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <!-- Left Panel -->
    <?= $this->include('layouts/left-panel') ?>

    <!-- Panel Kanan: Formulir Lupa Kata Sandi -->
    <div class="right-panel">
        <div class="form-content">
            <a href="<?= base_url('login') ?>" class="back-link">
                <i class="bi bi-chevron-left"></i>
                <span>Kembali ke Login</span>
            </a>

            <!-- Judul dan Subjudul -->
            <h1 class="form-title">Lupa Kata Sandi?</h1>
            <p class="form-subtitle">Jangan khawatir! Masukkan Email atau No HP yang terdaftar untuk menerima kode verifikasi OTP.</p>

            <!-- Alert Error / Sukses -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" style="background-color: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px; font-size: 14px;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success" style="background-color: #dcfce7; color: #16a34a; padding: 12px 16px; border-radius: 8px; font-size: 14px;">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('forgot-password') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Email / No HP -->
                <div class="form-group">
                    <label for="email_or_phone" class="label-text">Email atau No HP Terdaftar <span class="required">*</span></label>
                    <input id="email_or_phone" type="text" name="email_or_phone" value="<?= old('email_or_phone') ?>" placeholder="Contoh: user@gmail.com atau 08123456789" required class="input-field" autofocus>
                </div>

                <div class="info-box">
                    <i class="bi bi-info-circle me-1"></i> Kode OTP 5-digit akan dikirimkan untuk memastikan kepemilikan akun Anda.
                </div>

                <!-- Tombol Kirim -->
                <button type="submit" class="submit-button">
                    <i class="bi bi-send me-1"></i> Kirim Kode OTP
                </button>
            </form>

            <p class="register-text" style="text-align: center; margin-top: 24px;">
                Sudah ingat kata sandi Anda? <a href="<?= base_url('login') ?>" class="register-link">Silakan Login</a>
            </p>
        </div>
        <p class="noted-text">© <?= date('Y') ?> SEJIWA. Lindungi kerahasiaan informasi akun Anda.</p>
    </div>
</body>
</html>
