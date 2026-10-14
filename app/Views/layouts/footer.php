<!-- Footer Sejiwa -->
<footer class="footer sejiwa-footer py-5">
    <div class="container">
        <!-- Main Footer Content -->
        <div class="row g-4 align-items-start">
            <!-- Brand & Mission Column -->
            <div class="col-lg-4 col-md-6 col-12 mb-3 mb-md-0">
                <div class="footer-brand mb-3">
                    <a href="<?= base_url('dashboard') ?>" class="d-inline-flex align-items-center text-decoration-none text-white gap-2">
                        <span class="footer-logo-icon">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </span>
                        <span class="fs-4 fw-bold footer-brand-text">Sejiwa</span>
                    </a>
                </div>
                <p class="footer-desc mb-3">
                    Ruang aman, hangat, dan terpercaya bagi setiap ibu untuk merawat kesehatan mental, berbagi rasa, dan bertumbuh bersama komunitas yang saling menguatkan.
                </p>
                <div class="footer-emergency-box d-inline-flex align-items-center gap-2">
                    <i class="bi bi-shield-heart-fill"></i>
                    <span>Butuh teman bicara? Hubungi <a href="mailto:halo@sejiwa.id">halo@sejiwa.id</a></span>
                </div>
            </div>

            <!-- Fitur Utama Navigation -->
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="footer-heading">Fitur Utama</h6>
                <ul class="footer-links list-unstyled mb-0">
                    <li><a href="<?= base_url('dashboard') ?>"><i class="bi bi-chevron-right me-1"></i>Beranda</a></li>
                    <li><a href="<?= base_url('artikel') ?>"><i class="bi bi-chevron-right me-1"></i>Artikel Edukasi</a></li>
                    <li><a href="<?= base_url('daftar-video') ?>"><i class="bi bi-chevron-right me-1"></i>Video Edukatif</a></li>
                    <li><a href="<?= base_url('forum') ?>"><i class="bi bi-chevron-right me-1"></i>Forum Komunitas</a></li>
                    <li><a href="<?= base_url('dashboard#bisikan-ibu') ?>"><i class="bi bi-chevron-right me-1"></i>Bisikan Ibu</a></li>
                </ul>
            </div>

            <!-- Informasi & Bantuan -->
            <div class="col-lg-3 col-md-3 col-6">
                <h6 class="footer-heading">Bantuan & Info</h6>
                <ul class="footer-links list-unstyled mb-0">
                    <li><a href="<?= base_url('about') ?>"><i class="bi bi-chevron-right me-1"></i>Tentang Kami</a></li>
                    <li><a href="<?= base_url('register') ?>"><i class="bi bi-chevron-right me-1"></i>Gabung Komunitas</a></li>
                    <li><a href="<?= base_url('about') ?>"><i class="bi bi-chevron-right me-1"></i>Kebijakan Privasi</a></li>
                    <li><a href="<?= base_url('about') ?>"><i class="bi bi-chevron-right me-1"></i>Syarat & Ketentuan</a></li>
                    <li><a href="<?= base_url('about') ?>"><i class="bi bi-chevron-right me-1"></i>FAQ & Bantuan</a></li>
                </ul>
            </div>

            <!-- Komunitas & Media Sosial -->
            <div class="col-lg-3 col-md-12 col-12">
                <h6 class="footer-heading">Terhubung Bersama Kami</h6>
                <p class="footer-desc mb-3">
                    Ikuti cerita inspiratif, afirmasi positif, dan edukasi kesehatan mental setiap hari:
                </p>
                <div class="footer-social-wrapper d-flex flex-wrap gap-2 mb-3">
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="social-circle" title="Instagram Sejiwa" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="social-circle" title="TikTok Sejiwa" aria-label="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                    <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="social-circle" title="YouTube Sejiwa" aria-label="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="social-circle" title="Facebook Sejiwa" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="social-circle" title="X (Twitter) Sejiwa" aria-label="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                </div>
                <div class="footer-badge-comfort">
                    <i class="bi bi-patch-check-fill text-white me-1"></i>
                    <span>Ruang Empatik & Tanpa Penilaian</span>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="footer-bottom mt-4 pt-4 border-top border-white border-opacity-25">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <p class="mb-0 footer-copyright">
                        © <?= date('Y') ?> <strong>Sejiwa</strong>. Seluruh hak cipta dilindungi undang-undang.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 footer-credit">
                        Dirancang dengan penuh kasih untuk para Ibu Indonesia <i class="bi bi-heart-fill text-danger ms-1"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scoped Styling Footer Sejiwa -->
<style>
  .sejiwa-footer {
    background: linear-gradient(145deg, #d49cb2 0%, #b16b8e 100%);
    color: #ffffff;
    font-size: 14px;
    position: relative;
    box-shadow: 0 -4px 20px rgba(177, 107, 142, 0.12);
  }

  .footer-logo-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.22);
    backdrop-filter: blur(6px);
    font-size: 20px;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
  }

  .footer-brand-text {
    letter-spacing: 0.5px;
    font-family: 'Poppins', sans-serif;
  }

  .footer-desc {
    color: #fcebf2;
    font-size: 13.5px;
    line-height: 1.6;
    margin-bottom: 0;
  }

  .footer-emergency-box {
    background: rgba(255, 255, 255, 0.16);
    border: 1px solid rgba(255, 255, 255, 0.28);
    border-radius: 24px;
    padding: 6px 14px;
    font-size: 12.5px;
    color: #ffffff;
    backdrop-filter: blur(4px);
  }

  .footer-emergency-box a {
    color: #ffffff;
    font-weight: 600;
    text-decoration: underline;
    transition: opacity 0.2s ease;
  }

  .footer-emergency-box a:hover {
    opacity: 0.85;
  }

  .footer-heading {
    color: #ffffff;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: 0.3px;
    margin-bottom: 16px;
    position: relative;
    display: inline-block;
    padding-bottom: 6px;
  }

  .footer-heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 28px;
    height: 2.5px;
    background: #ffffff;
    border-radius: 2px;
    opacity: 0.85;
  }

  .footer-links li {
    margin-bottom: 9px;
  }

  .footer-links a {
    color: #fcebf2;
    text-decoration: none;
    font-size: 13.5px;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
  }

  .footer-links a i {
    font-size: 11px;
    opacity: 0.7;
    transition: transform 0.2s ease;
  }

  .footer-links a:hover {
    color: #ffffff;
    transform: translateX(4px);
  }

  .footer-links a:hover i {
    opacity: 1;
    transform: translateX(2px);
  }

  .footer-social-wrapper .social-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.18);
    color: #ffffff;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(255, 255, 255, 0.25);
  }

  .footer-social-wrapper .social-circle:hover {
    background: #ffffff;
    color: #b16b8e;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.18);
  }

  .footer-badge-comfort {
    display: inline-flex;
    align-items: center;
    background: rgba(0, 0, 0, 0.08);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    color: #fcebf2;
    font-weight: 500;
  }

  .footer-copyright {
    font-size: 13px;
    color: #fcebf2;
  }

  .footer-credit {
    font-size: 12.5px;
    color: #fcebf2;
  }

  @media (max-width: 767.98px) {
    .sejiwa-footer {
      padding-top: 36px !important;
      padding-bottom: 28px !important;
      text-align: left;
    }

    .footer-heading {
      margin-bottom: 12px;
      font-size: 14.5px;
    }

    .footer-emergency-box {
      font-size: 12px;
      width: 100%;
    }

    .footer-bottom {
      margin-top: 24px !important;
      padding-top: 18px !important;
      text-align: center;
    }
  }
</style>