<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
    'name',
    'email',
    'phone',
    'date_of_birth',
    'password',
    'role',
    'is_verified',
    'created_at',
    'updated_at' // Tambahkan ini
];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

     // Fungsi untuk mengambil semua data user
    public function getAllUsers()
    {
        return $this->findAll();
    }

    // Fungsi untuk mengambil user berdasarkan ID
    public function getUserById($id)
    {
        return $this->find($id);
    }

    public function deleteUserById($id)
    {
        return $this->delete($id);
    }

    public function updateUserById($id, $data)
    {
        return $this->update($id, $data);
    }
}
