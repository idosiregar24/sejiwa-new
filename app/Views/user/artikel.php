<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Artikel - Sejiwa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      line-height: 1.8;
    }

    .hero {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('https://source.unsplash.com/1600x500/?article,reading') center/cover no-repeat;
      color: white;
      padding: 130px 20px;
      text-align: center;
    }

    .article-img {
      width: 100%;
      max-height: 400px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 20px;
    }

    .related-articles {
      background-color: #fff;
      border-radius: 12px;
      padding: 40px 25px;
      margin-top: 60px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .card {
      border: none;
      transition: all 0.3s ease;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
    }

    .card-img-top {
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
      height: 180px;
      object-fit: cover;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <?= $this->include('layouts/navbar') ?>

  <!-- Hero Section -->
  <section class="hero">
    <h1 class="fw-bold">Mengenal Tanda-Tanda Stres pada Wanita</h1>
    <p class="text-light">Oleh : Lailanisa Fadlilani | 15 September 2025</p>
  </section>

  <!-- Artikel Content -->
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <img src="<?= base_url('assets/img/ilustrasi_ibu_dan_anak.png') ?>" alt="Gambar Artikel" class="article-img">

        <div style="text-align: justify; font-size: 1.05rem; line-height: 1.8;">
          <p> Hidup sebagai seorang wanita di masa sekarang memang menghadirkan beberapa tantangan. Banyak dari kita
            memainkan beberapa peran: di satu sisi sebagai pekerja profesional, di sisi lain sebagai pasangan, ibu, juga
            ibu rumah tangga. Seringkali, dorongan-dorongan untuk terlihat sempurna dan mampu menyelesaikan semuanya
            membuat kita berisiko stres. Stres dipandang dalam psikologi sebagai respons tubuh dan pikiran terhadap
            tekanan atau tuntutan yang melebihi kemampuan individu untuk menanganinya. Masalahnya adalah kita sering
            kurang mengetahui fakta bahwa kita benar-benar stres. Agar lebih sensitif, mari kita identifikasi tanda-
            tanda stres khas yang dialami wanita dalam aspek fisik, emosional, kognitif, dan perilaku. </p> <b>
            <p> 1. Tanda Fisik
            <p>
          </b> Sejak awal tubuh sering kali telah memberikan sinyal stress. Namun hal ini sering kali tidak kita sadari
          ataupun kita abaikan. Salah satu sinyal awal dari stress terlihat dari sering kali kita mengeluh merasakan
          sakit kepala berulang tanpa sebab yang jelas. Kemudian munculnya rasa nyeri di leher, bahu ataupun punggung,
          bahkan seringnya rasa lelah yang kita rasakan tidak hilang meskipun kita sudah tidur cukup. Sinyal lainnya
          yang bisa kita kenali adalah dengan adanya gangguan tidur, ada yang sulit tidur dan ada yang mudah terbangun
          di malam hari. Selain itu, perubahan pola makan juga menjadi sinyal dari tanda fisik. Sebagian orang menjadi
          ngemil berlebihan sementara yang lain justru kehilangan nafsu makan. Semua ini Adalah tanda bahwa tubuh sedang
          menanggung beban psikologis. </p>
          </p> <b>
            <p> 2. Tanda Emosional </p>
          </b> Emosi sering kali mencerminkan kondisi stres dengan sangat akurat. Perempuan yang mengalami stres umumnya
          menjadi lebih sensitif, cepat marah terhadap hal-hal sepele, atau merasa cemas secara berlebihan meskipun
          tidak ada alasan yang jelas. Perasaan sedih yang muncul secara tiba-tiba juga sering terjadi, disertai dengan
          rasa tidak berharga atau merasa gagal dalam menjalankan peran sebagai tenaga kerja, ibu, atau istri. Bahkan
          kegiatan yang biasanya menyenangkan juga bisa kehilangan daya pikatnya. Jika emosi terasa tidak stabil, ini
          mungkin merupakan tanda bahwa stres mulai mengambil alih diri. </p>
          </p> <b>
            <p> 3. Tanda Kognitif (Pikiran) </p>
          </b>
          <p> Stres pun memiliki dampak besar terhadap cara orang berpikir. Banyak perempuan yang menyatakan kesulitan
            untuk fokus saat bekerja atau mengatur urusan rumah, bahkan hal-hal sepele sering kali terabaikan. Pikiran
            tampak sesak, seolah tak pernah berhenti berputar. Dari situ, muncul kecenderungan untuk berpikir negatif,
            selalu bersiap menghadapi kemungkinan buruk yang dapat terjadi, dan pada akhirnya kesulitan dalam membuat
            keputusan. Pergeseran dalam pola pikir ini menambah beban yang dirasakan, karena produktivitas dan
            kepercayaan diri juga menurun. </p> <b>
            <p> 4. Tanda Perilaku </p>
          </b>
          <p> Selain perubahan fisik, emosi, dan pikiran, stres juga dapat terlihat dari adanya perubahan dalam pola
            perilaku sehari-hari. Contohnya, seseorang mungkin menjadi lebih suka menyendiri, enggan bertemu dengan
            teman-temannya, atau lebih memilih untuk tidak berinteraksi sosial. Ada pula yang terfokus pada pekerjaan
            atau aktivitas lain tanpa memberi diri mereka waktu untuk beristirahat. Selain itu, muncul juga kebiasaan
            buruk seperti merokok, makan berlebihan, atau berbelanja secara impulsif sebagai cara untuk melupakan
            masalah. Bahkan, ada juga yang mulai menunda-nunda tugas karena merasa terlalu terbebani dan kehilangan
            semangat. Semua perubahan dalam perilaku ini adalah tanda peringatan yang seharusnya tidak diabaikan. </p>
          <b>
            <p> Mengapa Penting Mengenali Tanda Ini? </p>
          </b>
          <p> Jika gejala stres tersebut tidak ditangani, akibatnya bisa cukup parah: kesehatan fisik mungkin menurun,
            hubungan dengan pasangan atau anak dapat terganggu, produktivitas kerja mungkin menurun, bahkan bisa
            berisiko menyebabkan gangguan mental seperti depresi atau kecemasan yang berkepanjangan. </p>
          <p> Stres adalah hal yang wajar dan manusiawi, apalagi bagi wanita yang memikul banyak peran sekaligus. Tetapi
            dengan mengenali tanda-tandanya sejak awal, kita bisa lebih sigap untuk mengambil langkah pencegahan.
            Menjaga diri sendiri bukanlah egois, melainkan bentuk tanggung jawab agar tetap sehat dan bahagia. </p>
        </div>

        <hr>
        <div class="d-flex justify-content-between">
          <span>❤️ 24</span>
          <span>💬 10</span>
          <span>📤 Bagikan</span>
        </div>
      </div>
    </div>

    <!-- Artikel Lainnya -->
    <div class="related-articles mt-5">
      <h3 class="fw-bold mb-4 text-center">Artikel Lainnya</h3>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="<?= base_url('assets/img/ilustrasi_sumber_daya.svg') ?>" class="card-img-top" alt="Mindfulness">
            <div class="card-body">
              <h5 class="card-title">5 Cara Praktis Melatih Mindfulness di Rumah</h5>
              <p class="card-text text-muted small">Oleh: Desy Winda | 22 September 2025</p>
              <p class="card-text">Temukan ketenangan dengan latihan sederhana untuk membantu ibu mengelola stres di
                tengah rutinitas harian...</p>
              <a href="#" class="btn btn-outline-secondary btn-sm">Baca Selengkapnya</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="<?= base_url('assets/img/ilustrasi_komunitas.svg') ?>" class="card-img-top" alt="Parenting">
            <div class="card-body">
              <h5 class="card-title">Menemani Anak Berkebutuhan Khusus dengan Hati Tenang</h5>
              <p class="card-text text-muted small">Oleh: Mita Fani | 18 September 2025</p>
              <p class="card-text">Pendekatan empatik dan sabar dapat membantu ibu membangun koneksi yang kuat dengan
                anak berkebutuhan khusus...</p>
              <a href="#" class="btn btn-outline-secondary btn-sm">Baca Selengkapnya</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="<?= base_url('assets/img/ilustrasi_relaksasi.svg') ?>" class="card-img-top" alt="Relaksasi">
            <div class="card-body">
              <h5 class="card-title">Relaksasi 10 Menit untuk Ibu Super Sibuk</h5>
              <p class="card-text text-muted small">Oleh: Anggy Trisnadoli | 10 September 2025</p>
              <p class="card-text">Luangkan waktu sejenak untuk diri sendiri—latihan pernapasan sederhana ini bisa bantu
                redakan stres dan cemas...</p>
              <a href="#" class="btn btn-outline-secondary btn-sm">Baca Selengkapnya</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?= $this->include('layouts/footer') ?>

</body>

</html>