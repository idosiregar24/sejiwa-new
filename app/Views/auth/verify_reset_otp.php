<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kode OTP - SEJIWA</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/verify_email.css') ?>">

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
        .dev-badge {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            color: #92400e;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin: 14px 0 16px 0;
            display: inline-block;
        }
        .code-input-container {
            margin: 24px 0 16px 0;
        }
        .form-subtitle {
            margin-bottom: 8px;
            line-height: 1.5;
        }
        .resend-btn-action {
            background: none;
            border: none;
            padding: 0;
            color: #b16b8e;
            font-weight: 700;
            cursor: pointer;
            text-decoration: underline;
            font-family: inherit;
            font-size: inherit;
        }
        .resend-btn-action:disabled {
            color: #9ca3af;
            cursor: not-allowed;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!-- Left Panel -->
    <?= $this->include('layouts/left-panel') ?>
    
    <!-- Panel Kanan: Formulir Verifikasi -->
    <div class="right-panel">
        <div class="form-content">
            <a href="<?= base_url('forgot-password') ?>" class="back-link">
                <i class="bi bi-chevron-left"></i>
                <span>Kembali</span>
            </a>

            <!-- Judul dan Subjudul -->
            <h1 class="form-title">Verifikasi Kode OTP</h1>
            <p class="form-subtitle">
                Kode 5-digit telah dikirimkan ke 
                <strong><?= esc($contact) ?></strong> (<?= esc(ucfirst($channel)) ?>)
            </p>

            <?php if (ENVIRONMENT === 'development' && session()->getFlashdata('dev_otp')): ?>
                <div class="dev-badge">
                    <i class="bi bi-code-slash me-1"></i> [Development Mode] Kode OTP Anda: <strong><?= session()->getFlashdata('dev_otp') ?></strong>
                </div>
            <?php endif; ?>

            <form id="resetOtpForm" action="<?= base_url('verify-reset-otp') ?>" method="post">
                <?= csrf_field() ?>
                
                <!-- Kotak Verifikasi 5 Digit -->
                <div class="code-input-container">
                    <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="code-input-box" autofocus>
                    <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="code-input-box">
                    <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="code-input-box">
                    <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="code-input-box">
                    <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="code-input-box">
                </div>

                <!-- Hidden input untuk OTP final -->
                <input type="hidden" name="otp" id="otp">

                <!-- Info Kirim Ulang -->
                <p class="resend-text">
                    Tidak menerima kode? 
                    <span id="countdownText">Kirim ulang dalam <strong id="timer">60</strong>s</span>
                    <button type="button" id="btnResend" class="resend-btn-action" style="display: none;">Kirim Ulang Kode</button>
                </p>
                
                <!-- Tombol Konfirmasi -->
                <button type="submit" id="submitBtn" class="submit-button">
                    <i class="bi bi-shield-check me-1"></i> Verifikasi & Lanjutkan
                </button>
            </form>
        </div>
        <p class="noted-text">© <?= date('Y') ?> SEJIWA. Pastikan hanya Anda yang memiliki akses ke kode verifikasi ini.</p>
    </div>

    <!-- Script Kontrol Input OTP & Resend -->
    <script>
        const inputs = document.querySelectorAll(".code-input-box");
        const otpHidden = document.getElementById("otp");
        const form = document.getElementById("resetOtpForm");
        const btnResend = document.getElementById("btnResend");
        const countdownText = document.getElementById("countdownText");
        const timerSpan = document.getElementById("timer");

        // Handle OTP input navigation
        inputs.forEach((input, index) => {
            input.addEventListener("input", (e) => {
                const val = e.target.value.replace(/[^0-9]/g, '');
                e.target.value = val;

                if (val && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateOtpValue();
            });

            input.addEventListener("keydown", (e) => {
                if (e.key === "Backspace" && !input.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            // Handle Paste full OTP (e.g. 5 digits pasted into any box)
            input.addEventListener("paste", (e) => {
                e.preventDefault();
                const pasteData = (e.clipboardData || window.clipboardData).getData("text").trim().replace(/[^0-9]/g, '');
                if (pasteData) {
                    const digits = pasteData.slice(0, inputs.length).split("");
                    digits.forEach((digit, i) => {
                        if (inputs[i]) inputs[i].value = digit;
                    });
                    const nextIndex = Math.min(digits.length, inputs.length - 1);
                    inputs[nextIndex].focus();
                    updateOtpValue();
                }
            });
        });

        function updateOtpValue() {
            otpHidden.value = Array.from(inputs).map(i => i.value).join("");
        }

        // Countdown timer 60s
        let timeLeft = 60;
        let timerInterval = null;

        function startTimer() {
            timeLeft = 60;
            countdownText.style.display = "inline";
            btnResend.style.display = "none";
            timerSpan.textContent = timeLeft;

            clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                timeLeft--;
                timerSpan.textContent = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    countdownText.style.display = "none";
                    btnResend.style.display = "inline";
                }
            }, 1000);
        }

        startTimer();

        // Resend OTP via AJAX
        btnResend.addEventListener("click", function() {
            btnResend.disabled = true;
            btnResend.textContent = "Mengirim...";

            fetch("<?= base_url('resend-reset-otp') ?>", {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "<?= csrf_token() ?>=<?= csrf_hash() ?>"
            })
            .then(res => res.json())
            .then(data => {
                btnResend.disabled = false;
                btnResend.textContent = "Kirim Ulang Kode";
                if (data.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Terkirim!",
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    if (data.dev_otp) {
                        console.log("Dev OTP:", data.dev_otp);
                    }
                    startTimer();
                } else {
                    Swal.fire("Gagal", data.message, "error");
                }
            })
            .catch(() => {
                btnResend.disabled = false;
                btnResend.textContent = "Kirim Ulang Kode";
                Swal.fire("Error", "Gagal menghubungi server untuk kirim ulang OTP.", "error");
            });
        });

        // Form Submission
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            updateOtpValue();

            if (otpHidden.value.length < 5) {
                Swal.fire({
                    icon: "warning",
                    title: "Kode Belum Lengkap",
                    text: "Silakan masukkan seluruh 5 digit kode OTP."
                });
                return;
            }

            const submitBtn = document.getElementById("submitBtn");
            submitBtn.disabled = true;
            submitBtn.innerHTML = "Memverifikasi...";

            const formData = new FormData(this);

            fetch("<?= base_url('verify-reset-otp') ?>", {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-shield-check me-1"></i> Verifikasi & Lanjutkan';

                if (data.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Verifikasi Berhasil!",
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = data.redirect;
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Verifikasi Gagal",
                        text: data.message,
                        confirmButtonText: "Coba Lagi"
                    });
                    inputs.forEach(i => i.value = "");
                    otpHidden.value = "";
                    inputs[0].focus();
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-shield-check me-1"></i> Verifikasi & Lanjutkan';
                Swal.fire("Error", "Terjadi kesalahan saat memproses data.", "error");
            });
        });
    </script>
</body>
</html>
