<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\ABranch;

class VedomostController extends Controller
{
    public function index()
    {
        $role = session('role_id');
		$users = session('user_name');
        $abit_branch = ABranch::GetBranch();
        return view('VedomostPage.main', [
                'title'         => 'Ведомости',
				'role' 			=> $role,
				'username' 		=> $users,
                'abit_branch'   => $abit_branch
            ]
        );
    }
}
