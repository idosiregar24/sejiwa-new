<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="<?= base_url('assets/css/register.css') ?>">

    <link rel="stylesheet" href="assets/css/globals.css" />
    <link rel="stylesheet" href="assets/css/styleguide.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
        /* Menggunakan font Poppins sebagai font utama */
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>

    <!-- left-panel -->
    <?= $this->include('layouts/left-panel') ?>

    <div class="right-panel">
        <div class="form-content">
            <h1 class="form-title">Registrasi Akun</h1>
            <p class="form-subtitle">Silahkan lengkapi formulir di bawah ini!</p>
            
            <form action="<?= base_url('register') ?>" method="post"  id="registerForm">
            <?= csrf_field() ?>    
            <div class="form-group">
                    <label for="name" class="label-text">Nama Lengkap <span class="required">*</span></label>
                    <div class="input-field">
                        <input id="name" type="text" name="name" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="label-text">Email/No HP <span class="required">*</span></label>
                    <div class="input-field">
                        <input id="email" type="text" name="email_or_phone" placeholder="Masukkan Email/No HP" required>
                    </div>
                </div>
                
                <input type="hidden" name="date_of_birth" id="date_of_birth">

                <div class="form-group">
                <label class="label-text">Tanggal Lahir <span class="required">*</span></label>
                <div class="date-of-birth-group">
                        <select name="tanggal" required>
                        <option value="">Tanggal</option>
                        <?php for($i=1;$i<=31;$i++): ?>
                         <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="bulan" required>
                <option value="">Bulan</option>
                <?php for($i=1;$i<=12;$i++): ?>
                    <option value="<?= $i ?>"><?= date('F', mktime(0,0,0,$i,10)) ?></option>
                <?php endfor; ?>
                    </select>
                    <select name="tahun" required>
                    <option value="">Tahun</option>
                <?php for($i=date('Y');$i>=1960;$i--): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
            </div>
            <?php if (session()->getFlashdata('errors')): ?>
    <div class="error-message">
        <ul>
        <?php foreach(session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

            <div class="form-group">
                    <label for="password" class="label-text">Kata Sandi <span class="required">*</span></label>
                    <div class="input-field">
                        <input id="password" type="password" name="password" placeholder="Masukkan Kata Sandi" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="constraint-item"><img class="check-icon" src="<?= base_url('assets/img/Vector.png')?>" /><div id="strength" class="check-text">Password Strength : Weak</div></div>
                    <div class="constraint-item"><img class="check-icon" src="<?= base_url('assets/img/Vector.png')?>" /><div id="no-name-email" class="check-text">Cannot contain your name or email address</div></div>
                    <div class="constraint-item"><img class="check-icon" src="<?= base_url('assets/img/Vector.png')?>" /><div id="min-length" class="check-text">At least 8 characters</div></div>
                    <div class="constraint-item"><img class="check-icon" src="<?= base_url('assets/img/Vector.png')?>" /><div id="has-symbol" class="check-text">Contains a number or symbol</div></div>
                </div>
                
                <div class="form-group">
                    <label for="password_confirm" class="label-text">Konfirmasi Kata Sandi <span class="required">*</span></label>
                    <div class="input-field">
                        <input id="password_confirm" type="password" name="password_confirm" placeholder="Konfirmasi Ulang Kata Sandi" required>
                    </div>
                </div>

                <div class="terms-and-conditions">
                    <input type="checkbox" name="agree" value="1" required>
                    <p class="terms-text">Saya setuju dengan <a href="#" class="terms-link">syarat dan ketentuan</a> ini</p>
                </div>
                <button type="submit" class="submit-button" name="submit">Daftar</button>
            </form>

            <p class="login-text">Sudah Punya Akun? <a href="/login" class="login-link">Log In</a></p>
        </div>
    </div>
</div>

<script>


const password = document.getElementById('password');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const strengthEl = document.getElementById('strength');
const minLengthEl = document.getElementById('min-length');
const hasSymbolEl = document.getElementById('has-symbol');
const noNameEmailEl = document.getElementById('no-name-email');
const passwordConfirm = document.getElementById('password_confirm');

//Menggabungkan tanggal lahir dan validasi kesamaan password
document.getElementById('registerForm').addEventListener('submit', function(e){
    const tgl = document.querySelector('select[name="tanggal"]').value;
    const bln = document.querySelector('select[name="bulan"]').value;
    const thn = document.querySelector('select[name="tahun"]').value;

    if(!tgl || !bln || !thn){
        e.preventDefault();
        alert('Tanggal lahir harus lengkap!');
        return;
    }

    document.getElementById('date_of_birth').value = 
        `${thn}-${String(bln).padStart(2,'0')}-${String(tgl).padStart(2,'0')}`;

    if (password.value !== passwordConfirm.value) {
        e.preventDefault();
        alert('Konfirmasi kata sandi tidak sesuai.');
        return;
    }
});

function checkPassword() {
    const val = password.value.toLowerCase();
    const nameVal = nameInput.value.trim().toLowerCase();
    const emailVal = emailInput.value.trim().toLowerCase();

    // Panjang password
    minLengthEl.style.color = val.length >= 8 ? 'green' : 'red';

    // Mengandung angka/simbol
    hasSymbolEl.style.color = /[0-9!@#$%^&*]/.test(val) ? 'green' : 'red';

    // Tidak mengandung nama/email
    if (val && !val.includes(nameVal) && !val.includes(emailVal)) {
        noNameEmailEl.style.color = 'green';
    } else {
        noNameEmailEl.style.color = 'red';
    }

    // Hitung kekuatan password
    let score = 0;
    if (val.length >= 8) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[!@#$%^&*]/.test(val)) score++;
    if (/[A-Z]/.test(password.value)) score++;

    if (score <= 1) {
        strengthEl.textContent = 'Password Strength : Weak';
        strengthEl.style.color = 'red';
    } else if (score === 2) {
        strengthEl.textContent = 'Password Strength : Medium';
        strengthEl.style.color = 'orange';
    } else {
        strengthEl.textContent = 'Password Strength : Strong';
        strengthEl.style.color = 'green';
    }
}

// Jalankan cek setiap kali salah satu input berubah
password.addEventListener('input', checkPassword);
nameInput.addEventListener('input', checkPassword);
emailInput.addEventListener('input', checkPassword);
</script>
</html>
