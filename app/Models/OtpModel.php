<?php

namespace App\Models;

use CodeIgniter\Model;

class OtpModel extends Model
{
    protected $table      = 'otp_codes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'otp_code',
        'channel',
        'expires_at',
        'is_used',
        'is_verified',
        'purpose',
        'updated_at_otp'
    ];

    // aktifkan otomatis timestamp
    protected $useTimestamps = true;

    // mapping ke nama kolom yang sesuai
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at_otp';
    protected $deletedField  = null; // kalau tidak pakai soft delete
}
