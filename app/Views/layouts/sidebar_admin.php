<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Admin Sejiwa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/css/layoutsCss/sidebar_admin.css') ?>">

  <style>
    /* Tambahan CSS untuk highlight menu */
    .sidebar .menu li a {
      display: block;
      padding: 10px 15px;
      color: #333;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.3s, color 0.3s;
    }

    .sidebar .menu li a:hover {
      background: #f8c8dc; /* pink muda */
      color: #fff;
    }

    .sidebar .menu li a.active {
      background: #B16B8E; /* pink saat aktif */
      color: #fff;
    }

    .user-profile {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px;
      border-top: 1px solid #ddd;
    }

    .user-profile img {
      border-radius: 50%;
    }

    .user-info {
      flex-grow: 1;
      margin-left: 10px;
    }

    .logout {
      color: #ff69b4;
      font-size: 1.2rem;
    }
  </style>
</head>
<body>

<aside class="sidebar">
  <div>
    <h2>Sejiwa</h2>
    <ul class="menu">
      <li>
        <a href="<?= base_url('dashboard_admin') ?>"
          class="<?= (service('uri')->getSegment(1) == 'dashboard_admin' ? 'active' : '') ?>">
          <i class="bi bi-grid"></i> Dashboard
        </a>
      </li>

      <li>
        <a href="<?= base_url('user_management') ?>"
          class="<?= (service('uri')->getSegment(1) == 'user_management' ? 'active' : '') ?>">
          <i class="bi bi-person"></i> Account
        </a>
      </li>

      <li>
        <a href="<?= base_url('content-management') ?>"
          class="<?= (service('uri')->getSegment(1) == 'content-management' ? 'active' : '') ?>">
          <i class="bi bi-mortarboard"></i> Educational
        </a>
      </li>

      <li>
        <a href="<?= base_url('forum-management') ?>"
          class="<?= (service('uri')->getSegment(1) == 'forum-management' ? 'active' : '') ?>">
          <i class="bi bi-chat-dots"></i> Forum
        </a>
      </li>

      <li><a href="#"><i class="bi bi-bar-chart"></i> Statistics</a></li>
      <li><a href="#"><i class="bi bi-gear"></i> Setting</a></li>

    </ul>
  </div>
  <div class="user-profile">
    <img src="https://via.placeholder.com/40" alt="User">
    <div class="user-info">
      <h4><?= session()->get('name') ?></h4>
      <p>Admin</p>
    </div>
    <a href="<?= base_url('logout') ?>">
      <i class="bi bi-box-arrow-right logout"></i>
    </a>
  </div>
</aside>

<script>
  // Menambahkan class active saat menu diklik
  document.querySelectorAll('.sidebar .menu li a').forEach(link => {
    link.addEventListener('click', function() {
      document.querySelectorAll('.sidebar .menu li a').forEach(el => el.classList.remove('active'));
      this.classList.add('active');
    });
  });
</script>

</body>
</html>
