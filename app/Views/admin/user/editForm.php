<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Konten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/content-management.css') ?>">
    <link rel="icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/96x96.png" sizes="96x96">
    <link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/120x120.png" sizes="120x120">
    <link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/152x152.png" sizes="152x152">
    <link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/167x167.png" sizes="167x167">
    <link rel="apple-touch-icon" type="image/png" href="https://ckeditor.com/assets/images/favicons/180x180.png" sizes="180x180">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/46.0.3/ckeditor5.css" crossorigin>

    <link rel="stylesheet" href="<?= base_url('assets/css/admin/content-form.css') ?>">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/42.0.0/classic/ckeditor.js"></script>
    <!-- CSS terpisah -->
    <link rel="stylesheet" href="styles.css">

</head>

<body>

    <!-- Sidebar -->
    <?= $this->include('layouts/sidebar_admin') ?>

    <div class="content">
        <!-- Header -->
        <header class="text-white flex justify-between items-center py-4 px-6 rounded-b-lg shadow-md" style="background-color: #B16B8E;">
            <!-- Kotak kiri dengan icon dan judul -->
            <div class="flex items-center space-x-4">
                <span class="text-2xl"></span>
                <h1 class="text-xl font-semibold tracking-wider">Manajemen Pengguna</h1>
            </div>

            <!-- Kotak kanan dengan icon notifikasi -->
            <div class="relative">
                <i class="fas fa-bell text-2xl"></i>
                <!-- Lingkaran kecil notifikasi -->
                <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full animate-ping"></span>
                <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full"></span>
            </div>
        </header>
        <main class="container mx-auto my-8 px-8">
            <div class="text-gray-500 text-sm mb-2">
                Pages / User / <span class="text-gray-800 font-semibold">Ubah Pengguna</span>
            </div>
            <h2 class="text-2xl font-bold mb-6">Ubah Pengguna</h2>

            <div class="bg-white shadow-lg p-8 rounded-lg">
                <form action="<?= base_url('user/update/' . $user['id']) ?>" method="post">
                    <!-- Nama Lengkap -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap <span class="text-pink-500">*</span></label>
                        <input type="text"
                            name="name"
                            value="<?= esc($user['name']) ?>"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors"
                            placeholder="Masukkan nama lengkap"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Email <span class="text-pink-500">*</span></label>
                        <input type="email"
                            name="email"
                            value="<?= esc($user['email']) ?>"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors"
                            placeholder="Masukkan email"
                            required>
                    </div>

                    <!-- Nomor HP -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Nomor HP</label>
                        <input type="text"
                            name="phone"
                            value="<?= esc($user['phone']) ?>"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors"
                            placeholder="Masukkan nomor HP">
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Tanggal Lahir</label>
                        <input type="date"
                            name="date_of_birth"
                            value="<?= esc($user['date_of_birth']) ?>"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors">
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Password <span class="text-pink-500">*</span></label>
                        <input type="password"
                            name="password"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors"
                            placeholder="Kosongkan jika tidak ingin mengubah password">
                        <small class="text-gray-500">Kosongkan jika tidak ingin mengubah password</small>
                    </div>

                    <!-- Role -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Role <span class="text-pink-500">*</span></label>
                        <select name="role"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors"
                            required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                        </select>
                    </div>

                    <!-- Status Verifikasi -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Status Verifikasi</label>
                        <select name="is_verified"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-colors">
                            <option value="1" <?= $user['is_verified'] == 1 ? 'selected' : '' ?>>Verified</option>
                            <option value="0" <?= $user['is_verified'] == 0 ? 'selected' : '' ?>>Not Verified</option>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end">
                        <a href="<?= base_url('user_management') ?>" class="bg-gray-400 text-white py-2 px-4 rounded-lg hover:bg-gray-500 transition">Batal</a>
                        <button type="submit" class="bg-pink-500 text-white py-2 px-4 rounded-lg hover:bg-pink-600 transition ml-2">Update</button>
                    </div>
                </form>

            </div>
        </main>
    </div>
    </div>

    <script src="<?= base_url('assets/ckeditor5-builder-46.0.3/main.js') ?>"></script>
</body>

</html>