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
        <h1 class="fs-4 fw-semibold mb-0">Educational Management</h1>
      </div>
      <div class="position-relative">
        <i class="fas fa-bell fs-4"></i>
        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
      </div>
    </header>

    <main class="container-fluid my-4 px-4">
      <!-- Title -->
      <div class="mb-3">
        <h3 class="mb-1">Konten Edukasi</h3>
        <p class="text-muted mb-0">Kelola semua konten edukatif untuk aplikasi Sejiwa</p>
      </div>

      <!-- Statistik -->
      <div class="row mb-4">
        <?php
          $statList = [
            ['label' => 'Total Konten', 'value' => $stats['total'] ?? 0],
            ['label' => 'Published', 'value' => $stats['published'] ?? 0],
            ['label' => 'Draft', 'value' => $stats['draft'] ?? 0],
            ['label' => 'Archived', 'value' => $stats['archived'] ?? 0],
          ];
          foreach ($statList as $stat):
        ?>
        <div class="col-md-3 mb-2">
          <div class="card text-center">
            <div class="card-body">
              <h4 class="mb-0"><?= $stat['value'] ?></h4>
              <p class="text-muted"><?= $stat['label'] ?></p>
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>

      <!-- Search + Action -->
      <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <input type="text" class="form-control w-auto" style="min-width:200px;" placeholder="Search..." aria-label="Search Konten">

      <form method="get" action="<?= base_url('content-management') ?>" 
          class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

      <div class="d-flex gap-2">
        <!-- Filter Jenis Konten -->
        <select name="jenis" class="form-select w-auto" onchange="this.form.submit()">
          <option value="all" <?= ($jenis == 'all' ? 'selected' : '') ?>>Semua Jenis</option>
          <option value="artikel" <?= ($jenis == 'artikel' ? 'selected' : '') ?>>Artikel</option>
          <option value="video" <?= ($jenis == 'video' ? 'selected' : '') ?>>Video</option>
          <option value="infografis" <?= ($jenis == 'infografis' ? 'selected' : '') ?>>Infografis</option>
          <option value="audio" <?= ($jenis == 'audio' ? 'selected' : '') ?>>Audio</option>
        </select>

        <!-- Filter Status -->
        <select name="status" class="form-select w-auto" onchange="this.form.submit()">
          <option value="all" <?= ($status == 'all' ? 'selected' : '') ?>>Semua Status</option>
          <option value="draft" <?= ($status == 'draft' ? 'selected' : '') ?>>Draft</option>
          <option value="published" <?= ($status == 'published' ? 'selected' : '') ?>>Published</option>
        </select>

        <a href="<?= base_url('/content/content_form') ?>" class="btn btn-primary">+ Tambah Konten</a>
      </div>
    </form>

    </div>


      <!-- Table -->
      <div class="card">
        <div class="card-body p-0">
          <table class="table table-striped mb-0">
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
                    <td><?= esc($c['title']) ?></td>
                    <td><?= esc($c['type']) ?></td>
                    <td><?= esc($c['category']) ?></td>
                    <td>
                      <span class="badge bg-<?= strtolower($c['status']) === 'published' ? 'success' : (strtolower($c['status']) === 'draft' ? 'warning' : 'secondary') ?>">
                        <?= esc($c['status']) ?>
                      </span>
                    </td>
                    <td><?= esc($c['created_at']) ?></td>
                    <td>
                      <a href="<?= base_url('content/edit/'.$c['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                      <a href="<?= base_url('content/delete/'.$c['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus konten ini?')">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="text-center">Belum ada konten</td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <script>
  document.getElementById("filterKonten").addEventListener("change", function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("table tbody tr");

    rows.forEach(row => {
      let jenis = row.cells[1]?.textContent.toLowerCase(); // kolom "Jenis"
      
      if (filter === "all" || jenis === filter) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
</script>


</body>
</html>