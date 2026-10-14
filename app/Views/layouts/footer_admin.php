<!-- Footer Admin Sejiwa -->
<footer class="admin-footer py-3 px-4 mt-auto">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
    <!-- Brand / Copyright -->
    <div class="text-muted text-center text-md-start" style="font-size: 13px;">
      <span>© <?= date('Y') ?> <strong style="color: #a55c7d;">Sejiwa Admin Panel</strong>. All rights reserved.</span>
    </div>

    <!-- Quick Links -->
    <div class="d-flex flex-wrap justify-content-center align-items-center gap-3" style="font-size: 13px;">
      <a href="<?= base_url('dashboard_admin') ?>" class="admin-footer-link">Dashboard</a>
      <a href="<?= base_url('user_management') ?>" class="admin-footer-link">Users</a>
      <a href="<?= base_url('content-management') ?>" class="admin-footer-link">Content</a>
      <a href="<?= base_url('forum-management') ?>" class="admin-footer-link">Forum</a>
      <a href="<?= base_url('dashboard') ?>" target="_blank" class="admin-footer-link">View Site <i class="bi bi-box-arrow-up-right ms-1"></i></a>
    </div>
  </div>
</footer>

<style>
.admin-footer {
  background: #ffffff;
  border-top: 1px solid #edf2f7;
  color: #718096;
  font-family: 'Inter', sans-serif;
}

.admin-footer-link {
  color: #718096;
  text-decoration: none;
  transition: color 0.2s ease;
}

.admin-footer-link:hover {
  color: #a55c7d;
  text-decoration: underline;
}
</style>
