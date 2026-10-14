<?php
  // Logika pengambilan data admin
  $adminPhoto = session()->get('photo');
  $adminId = session()->get('id');
  if (empty($adminPhoto) && $adminId) {
      $uModel = new \App\Models\UserModel();
      $uData = $uModel->find($adminId);
      if (!empty($uData['photo'])) {
          $adminPhoto = $uData['photo'];
          session()->set('photo', $adminPhoto);
      }
  }
  $adminName = session()->get('name') ?? 'Admin';
  $hasAdminPhoto = !empty($adminPhoto) && file_exists(FCPATH . 'uploads/profile_photo/' . $adminPhoto);
  $adminInitial = strtoupper(mb_substr(trim($adminName), 0, 1));
  $currentUri = service('uri')->getSegment(1);
?>

<!-- Load Bootstrap Icons & Sidebar CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="<?= base_url('assets/css/layoutsCss/sidebar_admin.css') ?>">

<!-- Topbar Khusus Mobile/Tablet (Hanya Tampil di Layar < 992px) -->
<div class="admin-mobile-topbar d-lg-none">
  <div class="d-flex align-items-center gap-2">
    <button type="button" class="btn btn-sidebar-toggle" id="adminSidebarToggle" aria-label="Buka Menu Admin">
      <i class="bi bi-list fs-5"></i>
    </button>
    <span class="admin-mobile-brand">Sejiwa Admin</span>
  </div>
  <div class="d-flex align-items-center gap-2">
    <a href="<?= base_url('dashboard') ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Lihat Website Beranda">
      <i class="bi bi-box-arrow-up-right"></i>
    </a>
    <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-outline-danger" title="Keluar">
      <i class="bi bi-box-arrow-right"></i>
    </a>
  </div>
</div>

<!-- Backdrop Gelap saat Sidebar Terbuka di Layar Sentuh/Mobile -->
<div class="admin-sidebar-backdrop" id="adminSidebarBackdrop"></div>

<!-- Sidebar Admin Utama -->
<aside class="sidebar" id="adminSidebar">
  <div>
    <div class="sidebar-header">
      <h2>Sejiwa</h2>
      <button type="button" class="btn btn-sm text-secondary d-lg-none" id="adminSidebarClose" aria-label="Tutup Menu">
        <i class="bi bi-x-lg fs-5"></i>
      </button>
    </div>
    
    <ul class="menu">
      <li>
        <a href="<?= base_url('dashboard_admin') ?>"
          class="<?= ($currentUri == 'dashboard_admin' ? 'active' : '') ?>">
          <i class="bi bi-grid"></i> Dashboard
        </a>
      </li>

      <li>
        <a href="<?= base_url('user_management') ?>"
          class="<?= ($currentUri == 'user_management' || $currentUri == 'user' ? 'active' : '') ?>">
          <i class="bi bi-person"></i> Account
        </a>
      </li>

      <li>
        <a href="<?= base_url('content-management') ?>"
          class="<?= ($currentUri == 'content-management' || $currentUri == 'content' ? 'active' : '') ?>">
          <i class="bi bi-mortarboard"></i> Educational
        </a>
      </li>

      <li>
        <a href="<?= base_url('forum-management') ?>"
          class="<?= ($currentUri == 'forum-management' || $currentUri == 'forum' ? 'active' : '') ?>">
          <i class="bi bi-chat-dots"></i> Forum
        </a>
      </li>

      <li><a href="#"><i class="bi bi-bar-chart"></i> Statistics</a></li>
      <li><a href="#"><i class="bi bi-gear"></i> Setting</a></li>
    </ul>
  </div>

  <!-- Profil Admin di Bawah Sidebar -->
  <div class="user-profile">
    <?php if ($hasAdminPhoto): ?>
      <img src="<?= base_url('uploads/profile_photo/' . esc($adminPhoto)) ?>" alt="<?= esc($adminName) ?>" width="40" height="40" style="object-fit: cover; border-radius: 50%;">
    <?php else: ?>
      <div style="width: 40px; height: 40px; min-width: 40px; border-radius: 50%; background: linear-gradient(135deg, #d49cb2 0%, #b16b8e 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px;">
        <?= esc($adminInitial) ?>
      </div>
    <?php endif; ?>
    <div class="user-info">
      <h4><?= esc($adminName) ?></h4>
      <p><?= esc(ucfirst(session()->get('role') ?? 'Admin')) ?></p>
    </div>
    <a href="<?= base_url('logout') ?>" title="Logout" class="logout" aria-label="Keluar">
      <i class="bi bi-box-arrow-right"></i>
    </a>
  </div>
</aside>

<!-- Skrip Interaktif Responsif Sidebar Admin -->
<script>
  (function() {
    function initAdminSidebar() {
      const toggleBtn = document.getElementById('adminSidebarToggle');
      const closeBtn  = document.getElementById('adminSidebarClose');
      const sidebar   = document.getElementById('adminSidebar');
      const backdrop  = document.getElementById('adminSidebarBackdrop');

      function openSidebar() {
        if (sidebar) sidebar.classList.add('show');
        if (backdrop) backdrop.classList.add('show');
        document.body.classList.add('admin-sidebar-open');
      }

      function closeSidebar() {
        if (sidebar) sidebar.classList.remove('show');
        if (backdrop) backdrop.classList.remove('show');
        document.body.classList.remove('admin-sidebar-open');
      }

      if (toggleBtn) {
        toggleBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          openSidebar();
        });
      }

      if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
          e.preventDefault();
          closeSidebar();
        });
      }

      if (backdrop) {
        backdrop.addEventListener('click', function() {
          closeSidebar();
        });
      }

      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          closeSidebar();
        }
      });

      // Tutup otomatis saat link diklik di layar kecil
      const menuLinks = document.querySelectorAll('#adminSidebar .menu li a');
      menuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
          if (window.innerWidth < 992) {
            closeSidebar();
          }
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initAdminSidebar);
    } else {
      initAdminSidebar();
    }
  })();
</script>
