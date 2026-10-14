<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\OtpModel;
use CodeIgniter\I18n\Time;

class AdminController extends BaseController
{

    public function dashboard_admin(){
        return view('admin/dashboard-admin');
    }

}