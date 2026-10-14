<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table = 'content_likes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['content_id', 'user_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    // mapping ke nama kolom yang sesuai
    protected $updatedField  = 'updated_at_likes';
    protected $deletedField  = null; // kalau tidak pakai soft delete

}
