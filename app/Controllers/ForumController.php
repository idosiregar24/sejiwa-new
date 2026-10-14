<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ForumController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $totalForums = 0;
        if ($db->tableExists('forums')) {
            $totalForums = $db->table('forums')->countAll();
        }

        $stats = [
            'total'     => $totalForums,
            'published' => 0,
            'draft'     => 0,
            'archived'  => 0,
        ];

        $contents = [];

        return view('admin/forum/forum-management', [
            'stats'    => $stats,
            'contents' => $contents,
        ]);
    }
}