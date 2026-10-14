<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ContentModel;
use App\Models\OtpModel;
use CodeIgniter\I18n\Time;

class UserController extends BaseController
{
    protected $contentModel;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
    }

    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->getAllUsers();
        return view('admin/user/user_management', $data);
    }

    public function addForm()
    {
        return view('admin/user/addForm');
    }

    public function store()
    {
        $userModel = new UserModel();

        // Ambil data dari form
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'date_of_birth' => $this->request->getPost('date_of_birth'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getPost('role'),
            'is_verified' => $this->request->getPost('is_verified') ? 1 : 0,
        ];

        // Simpan data ke database
        $userModel->save($data);

        // Redirect ke halaman user management dengan pesan sukses
        return redirect()->to('/user_management')->with('success', 'User berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $userModel = new UserModel();

        // Pastikan user ada
        $user = $userModel->getUserById($id);
        if (!$user) {
            return redirect()->to('/user_management')->with('error', 'User tidak ditemukan');
        }

        // Hapus user
        $userModel->deleteUserById($id);

        // Redirect dengan pesan sukses
        return redirect()->to('/user_management')->with('success', 'User berhasil dihapus');
    }

    public function editForm($id)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if (!$user) {
            return redirect()->to('/user_management')->with('error', 'User tidak ditemukan');
        }

        return view('admin/user/editForm', ['user' => $user]);
    }

    // Proses update user
    public function update($id)
    {
        $userModel = new UserModel();

        $user = $userModel->getUserById($id);
        if (!$user) {
            return redirect()->to('/user_management')->with('error', 'User tidak ditemukan');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            // 'phone' => $this->request->getPost('phone'),
            'date_of_birth' => $this->request->getPost('date_of_birth'),
            'role' => $this->request->getPost('role'),
            'is_verified' => $this->request->getPost('is_verified') ? 1 : 0,
        ];

        // Jika password diisi, update password
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $userModel->updateUserById($id, $data);

        return redirect()->to('/user_management')->with('success', 'User berhasil diupdate');
    }

    public function dashboard()
    {
        $videos = $this->contentModel
            ->where('type', 'Video')
            ->where('status', 'Published')
            ->findAll();

        $audios = $this->contentModel
            ->where('type', 'Audio')
            ->where('status', 'Published')
            ->findAll();

        return view('user/dashboard_user', [
        'videos' => $videos,
        'audios' => $audios
    ]);
    }

    public function about()
    {
        return view('user/about', [
    ]);
    }

    public function artikel()
    {
        return view('user/artikel', [
    ]);
    }

}
