<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = [
        'name',
        'email',
        'date_of_birth',
        'phone',
        'password',
        'photo',
        'updated_at'
    ];

    public function getProfileByUserId($userId)
    {
        return $this->where('id', $userId)->first();
    }

    public function updateProfile($userId, $data)
    {
        return $this->update($userId, $data);
    }
}
