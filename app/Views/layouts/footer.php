<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Sejiwa</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Konten utama -->
    <main class="flex-grow-1">
        <!-- Semua konten halaman di sini -->
    </main>

    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 text-center text-md-start mb-3 mb-md-0">
                    <ul class="footer-menu list-inline mb-2">
                        <li class="list-inline-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="list-inline-item"><a href="<?= base_url('artikel') ?>">Artikel</a></li>
                        <li class="list-inline-item"><a href="<?= base_url('about') ?>">Tentang Kami</a></li>
                        <li class="list-inline-item"><a href="<?= base_url('register') ?>">Daftar</a></li>
                    </ul>
                    <p class="mb-0 copyright">© 2025 Sejiwa. All right Reserved</p>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                    <p class="credit mt-2">Design & Developed by <span>Tim Developed</span></p>
                </div>
            </div>
        </div>
    </footer>
</body>


<!-- CSS -->
<style>
  .footer {
    background-color: #D49CB2; /* warna pink */
    color: #fff;
    font-size: 14px;
  }

  .footer-menu a {
    color: #fff;
    text-decoration: none;
    margin: 0 6px;
    transition: color 0.3s ease;
  }

  .footer-menu a:hover {
    color: #f0e2e9;
  }

  .social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    margin-left: 6px;
    border-radius: 50%;
    background-color: #b86f91;
    color: #fff;
    font-size: 18px;
    transition: background 0.3s ease;
  }

  .social-icons a:hover {
    background-color: #9b5778;
  }

  .copyright {
    font-size: 13px;
    color: #fce7f1;
  }

  .credit {
    font-size: 12px;
    color: #fce7f1;
  }

  .credit span {
    color: #fff;
    font-weight: 500;
  }
</style>

<!-- Bootstrap Icon CDN (jika belum dipasang) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</body>
</html>