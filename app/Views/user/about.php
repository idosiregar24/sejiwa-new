<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang - SEJIWA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .hero {
      background: linear-gradient(to right, #f8cdda, #f1a7f1);
      color: #333;
      padding: 80px 0;
    }
    .hero h1 {
      font-size: 3rem;
      font-weight: 700;
    }
    .card img {
      border-radius: 12px 12px 0 0;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <?= $this->include('layouts/navbar') ?>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start">
          <h1>About Sejiwa</h1>
          <p class="lead">
            SEJIWA, singkatan dari Sentra Edukasi Jiwa Ibu Welas Asih, adalah aplikasi berbasis web
            yang dirancang untuk mendukung kesehatan mental, emosional, dan edukatif bagi ibu pascapersalinan
            dengan anak berkebutuhan khusus. Aplikasi ini hadir untuk memberikan rasa terhubung,
            informasi terpercaya, dan ruang relaksasi bagi ibu yang menghadapi tantangan kompleks sehari-hari.
          </p>
        </div>
        <div class="col-md-6 text-center">
          <img src="<?= base_url('assets/img/ilustrasi_ibu_dan_anak.svg') ?>" class="img-fluid rounded" alt="Sejiwa Team">
        </div>
      </div>
    </div>
  </section>

  <!-- Tujuan dan Latar Belakang -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Tujuan dan Latar Belakang</h2>
      <p class="text-center mb-5">
        Kesehatan mental ibu pascapersalinan merupakan isu krusial yang semakin mendapat perhatian
        di bidang sosial dan medis. Ibu dengan anak berkebutuhan khusus menghadapi beban emosional dan fisik
        yang lebih berat, sehingga membutuhkan dukungan yang tepat. SEJIWA hadir untuk menjawab kebutuhan ini
        dengan menyediakan tiga pilar layanan utama yang membantu ibu mengelola stres, mendapatkan informasi
        terpercaya, dan menikmati ruang relaksasi.
      </p>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card shadow-sm">
            <img src="<?= base_url('assets/img/ilustrasi_komunitas.svg') ?>" class="card-img-top" alt="Komunitas Dukungan">
            <div class="card-body">
              <h5 class="card-title">Komunitas Dukungan</h5>
              <p class="card-text">Memberikan ruang bagi ibu untuk saling berbagi pengalaman dan dukungan secara online.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card shadow-sm">
            <img src="<?= base_url('assets/img/ilustrasi_sumber_daya.svg') ?>" class="card-img-top" alt="Sumber Daya">
            <div class="card-body">
              <h5 class="card-title">Sumber Daya Kesehatan Mental</h5>
              <p class="card-text">Menyediakan akses ke artikel, video, dan materi edukatif terkait kesehatan mental ibu pascapersalinan.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card shadow-sm">
            <img src="<?= base_url('assets/img/ilustrasi_relaksasi.svg') ?>" class="card-img-top" alt="Relaksasi dan Meditasi">
            <div class="card-body">
              <h5 class="card-title">Relaksasi & Meditasi</h5>
              <p class="card-text">Fitur untuk menenangkan pikiran, membantu mengurangi stres, dan meningkatkan kualitas hidup ibu.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?= $this->include('layouts/footer') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
