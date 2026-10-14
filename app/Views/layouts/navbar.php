<nav class="navbar navbar-expand-lg <?= session()->get('isLoggedIn') ? 'navbar-loggedin' : 'navbar-default' ?>">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="<?= base_url('dashboard') ?>">SEJIWA</a>

        <!-- Toggler (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
            <div class="d-flex align-items-center mt-3 mt-lg-0">
                <?php if(session()->get('isLoggedIn')): ?>
                    <!-- Ikon Search -->
                    <a href="<?= base_url('search') ?>" class="nav-icon me-3" title="Pencarian">
                        <i class="bi bi-search"></i>
                    </a>

                    <!-- Ikon Notifikasi -->
                    <a href="<?= base_url('notifications') ?>" class="nav-icon me-3" title="Notifikasi">
                        <i class="bi bi-bell"></i>
                    </a>

                    <?php
                        $userPhoto = session()->get('photo');
                        $userId = session()->get('id');
                        // Self-healing: if session photo is empty, fetch once from DB
                        if (empty($userPhoto) && $userId) {
                            $uModel = new \App\Models\UserModel();
                            $uData = $uModel->find($userId);
                            if (!empty($uData['photo'])) {
                                $userPhoto = $uData['photo'];
                                session()->set('photo', $userPhoto);
                            }
                        }
                        $userName = session()->get('name') ?? 'User';
                        $hasValidPhoto = !empty($userPhoto) && file_exists(FCPATH . 'uploads/profile_photo/' . $userPhoto);
                        $initial = strtoupper(mb_substr(trim($userName), 0, 1));
                    ?>
                    <!-- Dropdown Profil -->
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" 
                           id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if ($hasValidPhoto): ?>
                                <img src="<?= base_url('uploads/profile_photo/' . esc($userPhoto)) ?>" 
                                     alt="<?= esc($userName) ?>" width="34" height="34" class="rounded-circle shadow-sm" style="object-fit: cover; border: 2px solid #b16b8e;">
                            <?php else: ?>
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" 
                                     style="width: 34px; height: 34px; background: linear-gradient(135deg, #d49cb2 0%, #b16b8e 100%); font-size: 14px; border: 2px solid #ffffff;">
                                    <?= esc($initial) ?>
                                </div>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownUser">
                            <li><span class="dropdown-item-text fw-semibold text-truncate" style="max-width: 220px;">Halo, <?= esc($userName) ?></span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                            <?php if (strtolower((string)session()->get('role')) === 'admin'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('dashboard_admin') ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-login me-2">Masuk</a>
                    <a href="<?= base_url('register') ?>" class="btn btn-register">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
