<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SEJIWA</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Sidebar CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/layoutsCss/sidebar_admin.css') ?>">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --brand-primary: #B16B8E;
            --brand-primary-dark: #914d70;
            --brand-primary-light: #fdf2f7;
            --brand-secondary: #f8c8dc;
            --text-dark: #2d3748;
            --text-muted: #718096;
            --bg-light: #f8fafc;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 8px 24px rgba(177, 107, 142, 0.15);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            display: flex;
        }

        .content {
            margin-left: 240px;
            width: calc(100% - 240px);
            min-height: 100vh;
            padding: 24px 32px;
            background-color: var(--bg-light);
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                width: 100%;
                padding: 16px;
            }
        }

        /* Top Header Banner */
        .admin-header-banner {
            background: linear-gradient(135deg, #B16B8E 0%, #873e65 100%);
            border-radius: 16px;
            padding: 24px 28px;
            color: #ffffff;
            box-shadow: 0 10px 20px rgba(177, 107, 142, 0.25);
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .admin-header-banner h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 6px 0;
        }

        .admin-header-banner p {
            margin: 0;
            font-size: 14px;
            color: #fce7f1;
            font-family: 'Inter', sans-serif;
        }

        .date-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Stat Cards */
        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 22px 20px;
            border: 1px solid rgba(0, 0, 0, 0.04);
            box-shadow: var(--card-shadow);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 18px;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
            border-color: rgba(177, 107, 142, 0.2);
        }

        .stat-icon-wrapper {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .icon-users { background: #fdf2f7; color: #B16B8E; }
        .icon-content { background: #e0f2fe; color: #0284c7; }
        .icon-likes { background: #fef2f2; color: #ef4444; }
        .icon-forum { background: #f0fdf4; color: #16a34a; }

        .stat-info {
            flex-grow: 1;
        }

        .stat-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'Inter', sans-serif;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.1;
            margin-bottom: 6px;
        }

        .stat-subtext {
            font-size: 12px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Section Cards */
        .dashboard-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.04);
            box-shadow: var(--card-shadow);
            padding: 24px;
            margin-bottom: 24px;
            height: calc(100% - 24px);
        }

        .dashboard-card-title {
            font-size: 17px;
            font-weight: 600;
            color: var(--text-dark);
            margin: 0 0 18px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-card-title a {
            font-size: 13px;
            color: var(--brand-primary);
            text-decoration: none;
            font-weight: 500;
        }

        .dashboard-card-title a:hover {
            text-decoration: underline;
        }

        /* Quick Action Buttons */
        .quick-action-btn {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 12px 18px;
            border-radius: 12px;
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .quick-action-btn:hover {
            border-color: var(--brand-primary);
            color: var(--brand-primary);
            background: #fdf2f7;
            transform: translateY(-2px);
        }

        .quick-action-btn i {
            font-size: 18px;
            color: var(--brand-primary);
        }

        /* Modern Table */
        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
        }

        .custom-table th {
            background: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            padding: 12px 14px;
            border-bottom: 1px solid #edf2f7;
        }

        .custom-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .custom-table tr:last-child td {
            border-bottom: none;
        }

        .custom-table tr:hover td {
            background-color: #fafaf9;
        }

        .user-avatar-mini {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #fdf2f7;
            color: var(--brand-primary);
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            margin-right: 10px;
        }

        .badge-verified {
            background-color: #dcfce7;
            color: #166534;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 11px;
        }

        .badge-unverified {
            background-color: #fef3c7;
            color: #92400e;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 11px;
        }

        .badge-type {
            background-color: #e2e8f0;
            color: #334155;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge-status-published {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 11px;
        }

        .badge-status-draft {
            background-color: #f1f5f9;
            color: #64748b;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Admin -->
    <?= $this->include('layouts/sidebar_admin') ?>

    <!-- Konten Utama Dashboard Admin -->
    <main class="content">

        <!-- Header Banner -->
        <div class="admin-header-banner">
            <div>
                <h1>Dashboard Administrator</h1>
                <p>Selamat datang kembali, <strong><?= esc(session()->get('name') ?? 'Super Admin') ?></strong>! Pantau performa dan ringkasan platform SEJIWA.</p>
            </div>
            <div class="date-badge">
                <i class="bi bi-calendar3"></i>
                <span><?= date('l, d F Y') ?></span>
            </div>
        </div>

        <!-- 4 Kartu Statistik Ringkasan -->
        <div class="row g-4 mb-4">
            <!-- Total Pengguna -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon-wrapper icon-users">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Total Pengguna</div>
                        <div class="stat-value"><?= number_format($stats['total_users']) ?></div>
                        <div class="stat-subtext">
                            <span class="badge-verified"><i class="bi bi-check-circle me-1"></i><?= $stats['verified_users'] ?> Terverifikasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Edukasi -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon-wrapper icon-content">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Konten Edukasi</div>
                        <div class="stat-value"><?= number_format($stats['total_contents']) ?></div>
                        <div class="stat-subtext">
                            <span class="badge-status-published"><i class="bi bi-broadcast me-1"></i><?= $stats['published_count'] ?> Published</span>
                            <span class="badge-status-draft ms-1"><?= $stats['draft_count'] ?> Draft</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Interaksi (Likes & Komentar) -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon-wrapper icon-likes">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Interaksi Konten</div>
                        <div class="stat-value"><?= number_format($stats['total_likes'] + $stats['total_comments']) ?></div>
                        <div class="stat-subtext">
                            <span><i class="bi bi-heart me-1 text-danger"></i><?= $stats['total_likes'] ?></span>
                            <span class="ms-2"><i class="bi bi-chat-left-text me-1 text-primary"></i><?= $stats['total_comments'] ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diskusi Forum -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon-wrapper icon-forum">
                        <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-label">Diskusi Forum</div>
                        <div class="stat-value"><?= number_format($stats['total_forums']) ?></div>
                        <div class="stat-subtext">
                            <span class="text-success"><i class="bi bi-activity me-1"></i>Komunitas Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Cepat (Quick Actions) -->
        <div class="mb-4">
            <h6 class="text-muted text-uppercase mb-3 fw-bold" style="font-size: 12px; letter-spacing: 0.5px;">Aksi Cepat</h6>
            <div class="row g-3">
                <div class="col-lg-3 col-sm-6">
                    <a href="<?= base_url('content/content_form') ?>" class="quick-action-btn">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>+ Tambah Konten Edukasi</span>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="<?= base_url('user/addForm') ?>" class="quick-action-btn">
                        <i class="bi bi-person-plus-fill"></i>
                        <span>+ Tambah Akun Pengguna</span>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="<?= base_url('forum-management') ?>" class="quick-action-btn">
                        <i class="bi bi-chat-square-text-fill"></i>
                        <span>Kelola Diskusi Forum</span>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="<?= base_url('dashboard') ?>" target="_blank" class="quick-action-btn">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>Lihat Website Beranda</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bagian Grafik / Visual Analytics -->
        <div class="row g-4 mb-4">
            <!-- Line Chart: Tren Pengguna & Konten -->
            <div class="col-lg-8">
                <div class="dashboard-card">
                    <div class="dashboard-card-title">
                        <span><i class="bi bi-graph-up me-2 text-primary"></i>Tren Aktivitas (6 Bulan Terakhir)</span>
                    </div>
                    <div style="height: 280px; position: relative;">
                        <canvas id="activityTrendChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Doughnut Chart: Distribusi Tipe Konten -->
            <div class="col-lg-4">
                <div class="dashboard-card">
                    <div class="dashboard-card-title">
                        <span><i class="bi bi-pie-chart me-2 text-success"></i>Tipe Konten Edukasi</span>
                    </div>
                    <div style="height: 230px; position: relative;" class="d-flex justify-content-center align-items-center">
                        <canvas id="contentTypeChart"></canvas>
                    </div>
                    <div class="d-flex justify-content-around mt-3 text-center" style="font-size: 12px;">
                        <div>
                            <span class="d-inline-block rounded-circle me-1" style="width:10px;height:10px;background:#B16B8E;"></span> Video: <strong><?= $chartData['types']['video'] ?></strong>
                        </div>
                        <div>
                            <span class="d-inline-block rounded-circle me-1" style="width:10px;height:10px;background:#38bdf8;"></span> Audio: <strong><?= $chartData['types']['audio'] ?></strong>
                        </div>
                        <div>
                            <span class="d-inline-block rounded-circle me-1" style="width:10px;height:10px;background:#34d399;"></span> Artikel: <strong><?= $chartData['types']['article'] ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2 Tabel Data Terbaru -->
        <div class="row g-4">
            <!-- Pengguna Terbaru -->
            <div class="col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card-title">
                        <span><i class="bi bi-person-lines-fill me-2 text-secondary"></i>Pengguna Terbaru</span>
                        <a href="<?= base_url('user_management') ?>">Lihat Semua <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Pengguna</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Bergabung</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($recentUsers)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-3 text-muted">Belum ada data pengguna.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($recentUsers as $usr): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar-mini">
                                                        <?= strtoupper(substr(esc($usr['name']), 0, 1)) ?>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold text-dark"><?= esc($usr['name']) ?></div>
                                                        <div class="text-muted" style="font-size: 11px;"><?= esc($usr['email'] ?? $usr['phone'] ?? '-') ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge-type"><?= esc(ucfirst($usr['role'] ?? 'user')) ?></span>
                                            </td>
                                            <td>
                                                <?php if (!empty($usr['is_verified'])): ?>
                                                    <span class="badge-verified">Verified</span>
                                                <?php else: ?>
                                                    <span class="badge-unverified">Pending</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-muted" style="font-size: 12px;">
                                                <?= !empty($usr['created_at']) ? date('d M Y', strtotime($usr['created_at'])) : '-' ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Konten Edukasi Terbaru -->
            <div class="col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card-title">
                        <span><i class="bi bi-collection-play-fill me-2 text-danger"></i>Konten Edukasi Terbaru</span>
                        <a href="<?= base_url('content-management') ?>">Lihat Semua <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Judul Konten</th>
                                    <th>Tipe</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($recentContents)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-3 text-muted">Belum ada konten edukasi.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($recentContents as $cnt): ?>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold text-dark text-truncate" style="max-width: 200px;">
                                                    <?= esc($cnt['title']) ?>
                                                </div>
                                                <div class="text-muted" style="font-size: 11px;">
                                                    <?= esc($cnt['category'] ?? 'Umum') ?>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge-type">
                                                    <i class="bi bi-<?= strtolower($cnt['type'] ?? '') === 'video' ? 'camera-video' : (strtolower($cnt['type'] ?? '') === 'audio' ? 'music-note' : 'file-text') ?> me-1"></i>
                                                    <?= esc($cnt['type'] ?? '-') ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if (strtolower($cnt['status'] ?? '') === 'published'): ?>
                                                    <span class="badge-status-published">Published</span>
                                                <?php else: ?>
                                                    <span class="badge-status-draft"><?= esc(ucfirst($cnt['status'] ?? 'Draft')) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-muted" style="font-size: 12px;">
                                                <?= !empty($cnt['created_at']) ? date('d M Y', strtotime($cnt['created_at'])) : '-' ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Inisialisasi Chart.js -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Data dari Controller
            const chartLabels = <?= json_encode($chartData['labels']) ?>;
            const userCounts = <?= json_encode($chartData['users']) ?>;
            const contentCounts = <?= json_encode($chartData['contents']) ?>;

            // 1. Line Chart: Tren Aktivitas
            const ctxTrend = document.getElementById('activityTrendChart').getContext('2d');
            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [
                        {
                            label: 'Pengguna Terdaftar',
                            data: userCounts,
                            borderColor: '#B16B8E',
                            backgroundColor: 'rgba(177, 107, 142, 0.12)',
                            tension: 0.35,
                            fill: true,
                            pointBackgroundColor: '#B16B8E',
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 2.5
                        },
                        {
                            label: 'Konten Dibuat',
                            data: contentCounts,
                            borderColor: '#0284c7',
                            backgroundColor: 'rgba(2, 132, 199, 0.08)',
                            tension: 0.35,
                            fill: true,
                            pointBackgroundColor: '#0284c7',
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: { family: 'Poppins', size: 12 },
                                usePointStyle: true,
                                boxWidth: 8
                            }
                        },
                        tooltip: {
                            backgroundColor: '#2d3748',
                            titleFont: { family: 'Poppins', size: 12 },
                            bodyFont: { family: 'Inter', size: 12 },
                            cornerRadius: 8,
                            padding: 10
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: { family: 'Inter', size: 11 },
                                color: '#94a3b8'
                            },
                            grid: {
                                color: '#f1f5f9'
                            }
                        },
                        x: {
                            ticks: {
                                font: { family: 'Inter', size: 11 },
                                color: '#94a3b8'
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // 2. Doughnut Chart: Distribusi Tipe Konten
            const ctxType = document.getElementById('contentTypeChart').getContext('2d');
            const videoVal = <?= (int)($chartData['types']['video'] ?? 0) ?>;
            const audioVal = <?= (int)($chartData['types']['audio'] ?? 0) ?>;
            const articleVal = <?= (int)($chartData['types']['article'] ?? 0) ?>;

            // Fallback display if total is 0
            const hasData = (videoVal + audioVal + articleVal) > 0;
            const donutData = hasData ? [videoVal, audioVal, articleVal] : [1, 1, 1];
            const donutColors = hasData ? ['#B16B8E', '#38bdf8', '#34d399'] : ['#e2e8f0', '#cbd5e1', '#94a3b8'];

            new Chart(ctxType, {
                type: 'doughnut',
                data: {
                    labels: ['Video', 'Audio', 'Artikel'],
                    datasets: [{
                        data: donutData,
                        backgroundColor: donutColors,
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    if (!hasData) return 'Belum ada data';
                                    return context.label + ': ' + context.raw + ' konten';
                                }
                            }
                        }
                    },
                    cutout: '72%'
                }
            });
        });
    </script>
</body>
</html>
