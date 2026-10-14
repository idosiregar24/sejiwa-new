<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEJIWA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_user.css') ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg 
                 <?= session()->get('isLoggedIn') ? 'navbar-loggedin' : 'navbar-default' ?>">
                    <div class="container">
                        <!-- Brand -->
                        <a class="navbar-brand" href="<?= base_url('dashboard') ?>">SEJIWA</a>

                        <!-- Toggler (mobile) -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Menu -->
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('dashboard') ?>">Beranda</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('videos') ?>">Daftar Video</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('artikel') ?>">Artikel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('about') ?>">Tentang</a>
                                </li>
                            </ul>

                            <!-- Right Side -->
                            <div class="d-flex align-items-center">
                                <?php if(session()->get('isLoggedIn')): ?>
                                    <!-- Ikon Search -->
                                    <a href="<?= base_url('search') ?>" class="nav-icon me-3">
                                        <i class="bi bi-search"></i>
                                    </a>

                                    <!-- Ikon Notifikasi -->
                                    <a href="<?= base_url('notifications') ?>" class="nav-icon me-3">
                                        <i class="bi bi-bell"></i>
                                    </a>

                                    <!-- Dropdown Profil -->
                                    <div class="dropdown">
                                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" 
                                        id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="<?= base_url('uploads/profile/' . session()->get('photo')) ?>" 
                                                alt="Profile" width="32" height="32" class="rounded-circle">
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                            <li><span class="dropdown-item-text">Halo, <?= session()->get('name') ?></span></li>
                                            <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profil Saya</a></li>
                                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <a href="<?= base_url('login') ?>" class="btn btn-login">Masuk</a>
                                    <a href="<?= base_url('register') ?>" class="btn btn-register">Daftar</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
    </nav>
</body>
</html>
