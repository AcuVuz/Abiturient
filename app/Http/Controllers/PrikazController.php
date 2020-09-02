<?php

namespace App\Http\Controllers;

use App\AFormObuch;
use App\APrikaz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrikazController extends Controller
{
    public function index () {
        $role = session('role_id');
        $users = session('user_name');
        
        $prikaz = APrikaz::getAll();
        $fo = AFormObuch::All();

        return response()->view("PrikazPage.main", [
            'title'     => 'Приказы',
            'role' 		=> $role,
            'username' 	=> $users,
            'prikaz'    => $prikaz,
            'fo'        => $fo
        ]);
    }

    public function save(Request $request) {
        if ($request->prikaz_id == -1) {
            APrikaz::inserPrikaz($request->name, date('Y-m-d', strtotime($request->date_prikaz)), $request->fo_id, $request->is_budg);
        } else {
            APrikaz::updateById($request->prikaz_id, $request->name, date('Y-m-d', strtotime($request->date_prikaz)), $request->fo_id, $request->is_budg);
        }
    }

    public function delete(Request $request) {
        APrikaz::where('id', '=', $request->prikaz_id)->delete();
    }
}
