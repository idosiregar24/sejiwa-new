<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Sejiwa Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/layoutsCss/sidebar_admin.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/content-management.css') ?>">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Google Fonts - Inter & Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <?= $this->include('layouts/sidebar_admin') ?>

    <div class="content">
        <!-- Header -->
        <header class="text-white d-flex justify-content-between align-items-center py-3 py-md-4 px-3 px-md-4 rounded-bottom shadow flex-wrap gap-2" style="background-color: #b9226eff;">
            <div class="d-flex align-items-center gap-3">
                <h1 class="fs-4 fw-semibold mb-0">Manajemen Pengguna</h1>
            </div>
            <div class="position-relative">
                <i class="fas fa-bell fs-4"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
            </div>
        </header>

        <main class="container-fluid my-3 my-md-4 px-2 px-md-4">
            <!-- Title -->
            <div class="mb-3">
                <h3 class="mb-1">Manajemen Pengguna</h3>
                <p class="text-muted mb-0">Kelola semua data akun pengguna aplikasi Sejiwa</p>
            </div>

            <!-- Search + Action -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <input type="text" class="form-control flex-grow-1 flex-md-grow-0" style="min-width:200px; max-width:320px;" placeholder="Search..." aria-label="Search User">
                <div class="d-flex flex-wrap gap-2">
                    <a href="#" class="btn btn-secondary">Filter Role</a>
                    <a href="<?= base_url('/user/addForm') ?>" class="btn btn-primary text-nowrap">+ Tambah User</a>
                </div>
            </div>

            <!-- Table Responsif -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)) : ?>
                                    <?php
                                    $no = 1;
                                    foreach ($users as $user) :
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td class="fw-semibold"><?= esc($user['name']); ?></td>
                                            <td><?= esc($user['email']); ?></td>
                                            <td class="text-nowrap"><?= esc($user['phone'] ?? '-'); ?></td>
                                            <td class="text-nowrap"><?= esc($user['date_of_birth']); ?></td>
                                            <td><span class="badge bg-secondary"><?= ucfirst(esc($user['role'])); ?></span></td>
                                            <td><?= $user['is_verified'] ? '<span class="badge bg-success">Verified</span>' : '<span class="badge bg-danger">Not Verified</span>'; ?></td>
                                            <td class="text-nowrap">
                                                <a href="<?= base_url('user/editForm/' . $user['id']); ?>"
                                                    class="btn btn-sm btn-warning me-1"
                                                    title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('user/delete/' . $user['id']); ?>"
                                                    class="btn btn-sm btn-danger"
                                                    title="Hapus User"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">Tidak ada data user</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>