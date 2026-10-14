<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Video Sejiwa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        /* Body flex agar footer selalu di bawah */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex-grow: 1;
            padding-top: 70px; /* jika navbar fixed-top */
        }

        /* Hover effect untuk card */
        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            transition: transform 0.3s ease;
        }

        .card-img-top:hover {
            transform: scale(1.05);
        }

        .badge-category {
            font-size: 0.7rem;
            padding: 0.35em 0.5em;
            text-transform: uppercase;
        }

        .card-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .title-content {
            text-decoration: none;
            color: #000;
        }

        .title-content:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <?= $this->include('layouts/navbar') ?>

    <!-- Konten Utama -->
    <main class="flex-grow-1">
        <div class="container my-5">
            <h2 class="fw-bold mb-4 text-center">Semua Video Ruang Edukatif Sejiwa</h2>

            <?php if (!empty($videos)): ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php foreach ($videos as $video): ?>
                        <div class="col">
                            <div class="card shadow-sm h-100 rounded-3 overflow-hidden">
                                <!-- Thumbnail -->
                                <a href="<?= base_url('content/view/' . $video['id']) ?>">
                                    <img src="<?= base_url($video['thumbnail'] ?? 'assets/img/default-thumbnail.jpg') ?>"
                                        class="card-img-top" alt="<?= esc($video['title'] ?? 'No Title') ?>"
                                        style="height:180px; object-fit:cover;">
                                </a>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h6 class="fw-bold mb-2 card-title">
                                        <a href="<?= base_url('content/detail/' . $video['id']) ?>" class="title-content">
                                            <?= esc($video['title']) ?>
                                        </a>
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <span class="text-muted small">
                                            <i class="bi bi-heart-fill text-danger"></i> <?= $video['like_count'] ?? 0 ?>
                                        </span>
                                        <span class="badge bg-success badge-category"><?= esc($video['category']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-muted">Belum ada video yang tersedia.</p>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <?= $this->include('layouts/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
