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

        // Kirim data ke view
        return view('user/profile_user', [
            'profile' => $profile,
            'photo'   => $profile['photo'] ?? 'default.png' // fallback foto
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

        // ✅ Update juga data session biar sinkron
        session()->set([
            'name'  => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui');
    }


    public function updatePhoto()
    {
        $userId = session()->get('id'); // ambil id user dari session
        $profileModel = new ProfileModel();

        // Ambil file dari input
        $file = $this->request->getFile('profile_picture');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Nama baru random biar unik
            $newName = $file->getRandomName();

            // Pindahkan ke folder public/uploads
            $file->move(FCPATH . 'uploads/profile_photo/', $newName);

            // Hapus foto lama kalau ada
            $oldPhoto = $profileModel->getProfileByUserId($userId)['photo'] ?? null;
            if ($oldPhoto && file_exists(FCPATH . 'uploads/profile_photo/' . $oldPhoto)) {
                unlink(FCPATH . 'uploads/profile_photo/' . $oldPhoto);
            }

            // Update ke database pakai model
            $profileModel->updateProfile($userId, [
                'photo'      => $newName,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            // Update session biar langsung ke-refresh
            session()->set('photo', $newName);

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
        }
        return redirect()->back()->with('error', 'Gagal mengunggah foto.');
    }
}
