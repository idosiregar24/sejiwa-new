<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_user.css') ?>">
    <title>Dashboard SeJiwa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
            height: 300px;
            position: relative;
            margin-top: -20px;
        }

        .profile-img {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            border: 4px solid #fff;
            margin-top: -90px;
        }

        .profile-section {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
        }

        .stats span {
            display: block;
            font-weight: bold;
            font-size: 18px;
        }

        .stats small {
            color: gray;
        }

        .tabs-nav a {
            font-weight: bold;
            color: #a64ca6;
            margin-right: 20px;
            text-decoration: none;
        }

        .tabs-nav a.active {
            border-bottom: 2px solid #a64ca6;
            padding-bottom: 4px;
        }
    </style>
</head>

<body>
    <main>
        <!-- Menambahkan Navbar -->
        <?= $this->include('layouts/navbar') ?>
        <div class="header"></div>
        <div class="container mt-3">
            <div class="row">
                <!-- Profile Left -->
                <div class="col-md-3 text-center profile-section">
                    <div class="position-relative d-inline-block">
                        <!-- Foto profil -->
                        <img src="<?= base_url('uploads/' . (session()->get('photo') ?? 'default.png')) ?>"
                            alt="Foto Profil"
                            class="profile-img rounded-circle">

                        <!-- Tombol edit foto -->
                        <button type="button"
                            class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle shadow"
                            onclick="document.getElementById('uploadPhoto').click()">
                            <i class="bi bi-camera"></i>
                        </button>

                        <!-- Input file hidden -->
                        <form action="<?= base_url('profile/updatePhoto') ?>" method="post" enctype="multipart/form-data">
                            <input type="file" id="uploadPhoto" name="profile_picture" accept="image/*" style="display:none" onchange="this.form.submit()">
                        </form>
                    </div>
                    <h5 class="mt-3"><?= esc($profile['name'] ?? '-') ?></h5>
                    <p class="text-muted"><?= esc($profile['email'] ?? '-') ?></p>

                    <div class="d-flex justify-content-around stats my-3">
                        <div>
                            <span>122</span>
                            <small>followers</small>
                        </div>
                        <div>
                            <span>67</span>
                            <small>following</small>
                        </div>
                        <div>
                            <span>37K</span>
                            <small>likes</small>
                        </div>
                    </div>

                    <p class="fst-italic">"Ibu dari anak berkebutuhan khusus yang ingin berbagi pengalaman dan saling mendukung sesama ibu."</p>

                    <ul class="list-unstyled text-start">
                        <li><i class="bi bi-envelope"></i><?= esc($profile['email'] ?? '-') ?></li>
                        <li><i class="bi bi-telephone"></i> +62-812-3456-7890</li>
                        <li><i class="bi bi-geo-alt"></i> Jakarta Selatan, DKI Jakarta</li>
                        <li><i class="bi bi-heart"></i> Autism Spectrum Disorder</li>
                    </ul>

                    <!-- <div class="d-grid gap-2 mt-3">
                        <a href="<?= base_url('profile') ?>" class="btn btn-secondary">Batal</a>
                        <button class="btn btn-primary btn-sm">Simpan Perubahahan</button>
                    </div> -->
                </div>

                <!-- Post Right -->
                <div class="col">
                    <div class="card shadow-sm p-4">
                        <h5>Edit Profil</h5>
                        <form action="<?= base_url('profile/update') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="row g-3">
                                <!-- Nama -->
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap*</label>
                                    <input type="text" name="name"
                                        class="form-control"
                                        value="<?= old('name', $profile['name']) ?>">
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="form-label">Email*</label>
                                    <input type="email" name="email"
                                        class="form-control"
                                        value="<?= old('email', $profile['email']) ?>">
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir*</label>
                                    <input type="date" name="date_of_birth"
                                        class="form-control"
                                        value="<?= old('date_of_birth', $profile['date_of_birth']) ?>">
                                </div>

                                <!-- Nomor HP -->
                                <div class="col-md-6">
                                    <label class="form-label">Nomor HP*</label>
                                    <input type="text" name="phone"
                                        class="form-control"
                                        value="<?= old('phone', $profile['phone']) ?>">
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('profile') ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menambahkan Navbar -->
        <?= $this->include('layouts/footer') ?>
    </main>
</body>


</html>