<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProfileModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $profileModel = new ProfileModel();

        // Ambil userId langsung dari session
        $userId = session()->get('id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login dulu');
        }

        // Ambil data profil berdasarkan user_id
        $profile = $profileModel->getProfileByUserId($userId);

        if (!$profile) {
            return redirect()->to('/login')->with('error', 'Profil tidak ditemukan');
        }

        // Sinkronisasi session photo jika belum ada
        if (!empty($profile['photo']) && session()->get('photo') !== $profile['photo']) {
            session()->set('photo', $profile['photo']);
        }

        // Kirim data ke view
        return view('user/profile_user', [
            'profile' => $profile,
            'photo'   => $profile['photo'] ?? null
        ]);
    }

    public function edit()
    {
        $profileModel = new ProfileModel();
        $userId = session()->get('id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login dulu');
        }

        $profile = $profileModel->getProfileByUserId($userId);

        // Sinkronisasi session photo jika belum ada
        if (!empty($profile['photo']) && session()->get('photo') !== $profile['photo']) {
            session()->set('photo', $profile['photo']);
        }

        return view('user/profile_edit', ['profile' => $profile]);
    }

    public function update()
    {
        $profileModel = new ProfileModel();
        $userId = session()->get('id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login dulu');
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'  => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'permit_empty|numeric'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ];

        // Update ke database
        $profileModel->updateProfile($userId, $data);

        // Update juga data session biar sinkron
        session()->set([
            'name'  => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePhoto()
    {
        $userId = session()->get('id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $validationRule = [
            'profile_picture' => [
                'label' => 'Foto Profil',
                'rules' => [
                    'uploaded[profile_picture]',
                    'is_image[profile_picture]',
                    'mime_in[profile_picture,image/jpg,image/jpeg,image/png,image/webp]',
                    'max_size[profile_picture,4096]',
                ],
                'errors' => [
                    'uploaded' => 'Silakan pilih file foto terlebih dahulu.',
                    'is_image' => 'File yang diunggah harus berupa gambar yang valid.',
                    'mime_in'  => 'Format foto harus berupa JPG, JPEG, PNG, atau WEBP.',
                    'max_size' => 'Ukuran file foto maksimal adalah 4MB.'
                ]
            ]
        ];

        if (!$this->validate($validationRule)) {
            $errorMsg = $this->validator->getError('profile_picture') ?? 'Gagal mengunggah foto.';
            return redirect()->back()->with('error', $errorMsg);
        }

        $file = $this->request->getFile('profile_picture');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/profile_photo/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Nama file acak dan unik
            $newName = $file->getRandomName();

            // Pindahkan file ke direktori tujuan
            $file->move($uploadDir, $newName);

            $profileModel = new ProfileModel();
            $currentProfile = $profileModel->getProfileByUserId($userId);
            $oldPhoto = $currentProfile['photo'] ?? null;

            // Hapus foto lama bila ada di disk
            if (!empty($oldPhoto) && file_exists($uploadDir . $oldPhoto) && is_file($uploadDir . $oldPhoto)) {
                unlink($uploadDir . $oldPhoto);
            }

            // Update ke database
            $profileModel->updateProfile($userId, [
                'photo'      => $newName,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            // Update session agar langsung aktif di seluruh halaman & navbar
            session()->set('photo', $newName);

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Gagal memproses file foto.');
    }
}
