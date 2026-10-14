<?php

namespace App\Controllers;

use App\Models\ContentModel;

class ForumController extends BaseController
{
    public function __construct()
    {

    }

public function index()
{
        return view('admin/forum/forum-management');
    }

}