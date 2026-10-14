<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forum Management - Sejiwa Admin</title>
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
        <h1 class="fs-4 fw-semibold mb-0">Forum Management</h1>
      </div>
      <div class="position-relative">
        <i class="fas fa-bell fs-4"></i>
        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
      </div>
    </header>

    <main class="container-fluid my-3 my-md-4 px-2 px-md-4">
      <!-- Title -->
      <div class="mb-3">
        <h3 class="mb-1">Moderasi Forum</h3>
        <p class="text-muted mb-0">Kelola Diskusi dan Moderasi Forum Komunitas</p>
      </div>

      <!-- Statistik -->
      <div class="row mb-3">
        <?php
          $statList = [
            ['label' => 'Total Diskusi', 'value' => $stats['total'] ?? 0],
            ['label' => 'Diskusi Bermaslah', 'value' => $stats['published'] ?? 0],
            ['label' => 'Perlu Perhatian', 'value' => $stats['draft'] ?? 0],
            ['label' => 'Ditangani', 'value' => $stats['archived'] ?? 0],
          ];
          foreach ($statList as $stat):
        ?>
        <div class="col-6 col-md-3 mb-2">
          <div class="card text-center shadow-sm">
            <div class="card-body p-3">
              <h4 class="mb-0 fs-5"><?= $stat['value'] ?></h4>
              <p class="text-muted mb-0 small"><?= $stat['label'] ?></p>
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>

      <!-- Search + Action -->
      <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <input type="text" class="form-control flex-grow-1 flex-md-grow-0" style="min-width:200px; max-width:320px;" placeholder="Search..." aria-label="Search Konten">
        <div class="d-flex flex-wrap gap-2">
          <a href="#" class="btn btn-secondary">Filter Jenis Konten</a>
          <a href="<?= base_url('/content/content_form') ?>" class="btn btn-primary text-nowrap">+ Tambah Konten</a>
        </div>
      </div>

      <!-- Table Responsif -->
      <div class="card shadow-sm">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Judul</th>
                  <th>Jenis</th>
                  <th>Kategori</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($contents)): ?>
                  <?php foreach ($contents as $c): ?>
                    <tr>
                      <td class="fw-semibold"><?= esc($c['title']) ?></td>
                      <td><?= esc($c['type']) ?></td>
                      <td><?= esc($c['category']) ?></td>
                      <td>
                        <span class="badge bg-<?= strtolower($c['status']) === 'published' ? 'success' : (strtolower($c['status']) === 'draft' ? 'warning' : 'secondary') ?>">
                          <?= esc($c['status']) ?>
                        </span>
                      </td>
                      <td class="text-nowrap"><?= esc($c['created_at']) ?></td>
                      <td class="text-nowrap">
                        <a href="<?= base_url('content/edit/'.$c['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= base_url('content/delete/'.$c['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus konten ini?')">Hapus</a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada konten</td>
                  </tr>
                <?php endif ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>