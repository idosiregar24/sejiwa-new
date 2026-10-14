<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/verify_email.css') ?>">
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS Eksternal -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- left-panel -->
    <?= $this->include('layouts/left-panel') ?>
    
    <!-- Panel Kanan: Formulir Verifikasi -->
        <div class="right-panel">
            <div class="form-content">
                <a href="\login" class="back-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Kembali</span>
                </a>
                <!-- Judul dan Subjudul -->
                <h1 class="form-title">Verifikasi Email atau No HP</h1>
                <?php if ($channel === 'email'): ?>
                    <p class="form-subtitle">
                        Kode verifikasi dikirim ke email <strong><?= esc($user['email']) ?></strong>
                    </p>
                <?php else: ?>
                    <p class="form-subtitle">
                        Kode verifikasi dikirim ke nomor HP +<strong><?= esc($user['phone']) ?></strong>
                </p>
                <?php endif; ?>


                <form id="otpForm" action="<?= site_url('resendVerification') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <!-- Kotak Verifikasi -->
                    <div class="code-input-container">
                        <input type="text" maxlength="1" class="code-input-box">
                        <input type="text" maxlength="1" class="code-input-box">
                        <input type="text" maxlength="1" class="code-input-box">
                        <input type="text" maxlength="1" class="code-input-box">
                        <input type="text" maxlength="1" class="code-input-box">
                    </div>

                    <!-- Hidden input untuk OTP final -->
                    <input type="hidden" name="otp" id="otp">

                    <!-- Tidak menerima -->
                    <p class="resend-text">Tidak menerima Kode Verifikasi? <a href="<?= base_url('resendVerification') ?>" class="resend-link">Kirim Ulang</a> atau coba <a href="#" class="resend-link">Metode lain</a></p>
                    
                    <!-- Tombol Konfirmasi -->
                    <button type="submit" class="submit-button">Confirm</button>
                </form>
            </div>
        </div>

<!-- Script untuk menggabungkan OTP -->
    <script>
            const inputs = document.querySelectorAll(".code-input-box");
            const otpInput = document.getElementById("otp");
            const form = document.getElementById("otpForm");

            inputs.forEach((input, index) => {
                input.addEventListener("input", () => {
                    if (input.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    otpInput.value = Array.from(inputs).map(i => i.value).join("");
                });

                input.addEventListener("keydown", (e) => {
                    if (e.key === "Backspace" && !input.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });

            form.addEventListener("submit", (e) => {
                otpInput.value = Array.from(inputs).map(i => i.value).join("");
            });

    </script>
    <script>
    document.getElementById("otpForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("<?= base_url('verifyOtp') ?>", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            Swal.fire({
            iconHtml: '<img src="<?= base_url('assets/img/SuccesIcon.svg') ?>" style="width:80px; height:80px; ">',
            title: '<span style="color:#22c55e; font-size:24px; font-weight:700;">Account Created Successfully!</span>',
            html: '<p style="margin-top:10px; font-size:16px; color:#333;">Terima kasih telah mendaftar. Silakan login untuk mulai.</p>',
            showConfirmButton: true,    
            confirmButtonText: 'Lets Start!',
            confirmButtonColor: '#22c55e',
            customClass: {
                popup: 'rounded-xl shadow-lg',
                confirmButton: 'px-6 py-2 text-white font-semibold rounded-full shadow-md'
            }
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/login'; // redirect ke login
            }
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: data.message,
                confirmButtonText: "Coba Lagi"
            });
        }
    })
    .catch(err => {
        Swal.fire("Error", "Terjadi kesalahan sistem!", "error");
    });
});
</script>

</body>
</html>

