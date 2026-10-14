<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kata Sandi Baru - SEJIWA</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .password-wrapper .input-field {
            padding-right: 45px;
            width: 100%;
        }
        .toggle-password {
            position: absolute;
            right: 14px;
            cursor: pointer;
            color: #9ca3af;
            font-size: 18px;
            transition: color 0.2s;
        }
        .toggle-password:hover {
            color: #b16b8e;
        }
        .match-feedback {
            font-size: 12px;
            margin-top: 5px;
            font-weight: 500;
        }
        .match-ok {
            color: #16a34a;
        }
        .match-bad {
            color: #dc2626;
        }
    </style>
</head>
<body>

    <!-- Left Panel -->
    <?= $this->include('layouts/left-panel') ?>

    <!-- Panel Kanan: Formulir Reset Password -->
    <div class="right-panel">
        <div class="form-content">
            <h1 class="form-title">Kata Sandi Baru</h1>
            <p class="form-subtitle">Buat kata sandi baru yang kuat dan mudah Anda ingat (minimal 6 karakter).</p>

            <!-- Alert Error / Validasi -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" style="background-color: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px; font-size: 14px;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (isset($validation)): ?>
                <div class="alert alert-danger" style="background-color: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px; font-size: 14px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($validation->getErrors() as $err): ?>
                            <li><?= esc($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form id="resetForm" action="<?= base_url('reset-password') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Kata Sandi Baru -->
                <div class="form-group">
                    <label for="password" class="label-text">Kata Sandi Baru <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password" type="password" name="password" placeholder="Minimal 6 karakter" required minlength="6" class="input-field" autofocus>
                        <i class="bi bi-eye toggle-password" data-target="password"></i>
                    </div>
                </div>

                <!-- Konfirmasi Kata Sandi Baru -->
                <div class="form-group" style="margin-top: 14px;">
                    <label for="password_confirm" class="label-text">Konfirmasi Kata Sandi Baru <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password_confirm" type="password" name="password_confirm" placeholder="Ulangi kata sandi baru" required minlength="6" class="input-field">
                        <i class="bi bi-eye toggle-password" data-target="password_confirm"></i>
                    </div>
                    <div id="matchNotice" class="match-feedback"></div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" id="btnSubmit" class="submit-button" style="margin-top: 24px;">
                    <i class="bi bi-check2-circle me-1"></i> Simpan Kata Sandi Baru
                </button>
            </form>
        </div>
        <p class="noted-text">© <?= date('Y') ?> SEJIWA. Pastikan kata sandi Anda aman dan tidak digunakan di situs lain.</p>
    </div>

    <!-- Toggle Password Visibility & Match Validator -->
    <script>
        document.querySelectorAll(".toggle-password").forEach(icon => {
            icon.addEventListener("click", function() {
                const targetId = this.dataset.target;
                const input = document.getElementById(targetId);
                if (input.type === "password") {
                    input.type = "text";
                    this.classList.remove("bi-eye");
                    this.classList.add("bi-eye-slash");
                } else {
                    input.type = "password";
                    this.classList.remove("bi-eye-slash");
                    this.classList.add("bi-eye");
                }
            });
        });

        const passInput = document.getElementById("password");
        const confirmInput = document.getElementById("password_confirm");
        const matchNotice = document.getElementById("matchNotice");
        const form = document.getElementById("resetForm");

        function checkMatch() {
            if (!confirmInput.value) {
                matchNotice.textContent = "";
                return true;
            }
            if (passInput.value === confirmInput.value) {
                matchNotice.textContent = "✓ Kata sandi cocok";
                matchNotice.className = "match-feedback match-ok";
                return true;
            } else {
                matchNotice.textContent = "✗ Kata sandi belum cocok";
                matchNotice.className = "match-feedback match-bad";
                return false;
            }
        }

        passInput.addEventListener("input", checkMatch);
        confirmInput.addEventListener("input", checkMatch);

        form.addEventListener("submit", function(e) {
            if (passInput.value.length < 6) {
                e.preventDefault();
                Swal.fire("Kata Sandi Terlalu Pendek", "Kata sandi minimal harus 6 karakter.", "warning");
                return;
            }
            if (passInput.value !== confirmInput.value) {
                e.preventDefault();
                Swal.fire("Tidak Cocok", "Konfirmasi kata sandi tidak cocok dengan kata sandi baru.", "warning");
                return;
            }
        });
    </script>
</body>
</html>
