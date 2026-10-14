<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Management - Konten Edukasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/content-management.css') ?>">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <?= $this->include('layouts/sidebar_admin') ?>

    <div class="content">
        <!-- Header -->
        <header class="text-white d-flex justify-content-between align-items-center py-4 px-4 rounded-bottom shadow" style="background-color: #b9226eff;">
            <div class="d-flex align-items-center gap-3">
                <h1 class="fs-4 fw-semibold mb-0">Manajemen Pengguna</h1>
            </div>
            <div class="position-relative">
                <i class="fas fa-bell fs-4"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
            </div>
        </header>

        <main class="container-fluid my-4 px-4">
            <!-- Title -->
            <div class="mb-3">
                <h3 class="mb-1">Manajemen Pengguna</h3>
                <p class="text-muted mb-0">Kelola semua konten edukatif untuk aplikasi Sejiwa</p>
            </div>

            <!-- Search + Action -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <input type="text" class="form-control w-auto" style="min-width:200px;" placeholder="Search..." aria-label="Search Konten">
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-secondary">Filter Jenis Konten</a>
                    <a href="<?= base_url('/user/addForm') ?>" class="btn btn-primary">+ Tambah User</a>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
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
                                $no = 1; // Inisialisasi nomor urut dimulai dari 1
                                foreach ($users as $user) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $user['name']; ?></td>
                                        <td><?= $user['email']; ?></td>
                                        <td><?= $user['phone'] ?? '-'; ?></td>
                                        <td><?= $user['date_of_birth']; ?></td>
                                        <td><?= ucfirst($user['role']); ?></td>
                                        <td><?= $user['is_verified'] ? '<span class="badge bg-success">Verified</span>' : '<span class="badge bg-danger">Not Verified</span>'; ?></td>
                                        <td>
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
                                    <td colspan="8" class="text-center">Tidak ada data user</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>