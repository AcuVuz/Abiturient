<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function __construct()
    {
    }
    public function index()
    {
        return view('Reset-PasswordPage.reset-password',['title' => 'Восстановление пароля']);
    }

    function resetPassword(Request $request)
    {
        $pers = DB::table('persons')->where('login', $request->login)->where('email', $request->email)->first();
        if ($pers != null)
        {
            DB::table('persons')->where('id', $pers->id)->update(['password' => Hash::make($request->password)]);
            return 0;
        }
        else return -1;
    }
}
