<?php

namespace App\Http\Controllers;

use App\AFormObuch;
use App\APrikaz;
use App\ASTLevel;
use App\AFacultet;
use App\AStatments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovePrikaz extends Controller
{

    public function index () {
        $role = session('role_id');
        $users = session('user_name');

        $prikaz = APrikaz::getAll();
        $fo = AFormObuch::All();
        $stlevel = ASTLevel::All();
        $fakultet = AFacultet::orderby('name')->get();

        return response()->view("MovePrikazPage.Move_Prikaz_Page", [
            'title'     => 'Перенос людей в приказы',
            'role' 		=> $role,
            'username' 	=> $users,
            'prikaz'    => $prikaz,
            'fo'        => $fo,
            'stlevel' => $stlevel,
            'fakultet' => $fakultet
            ]);
    }

    public function GetGroupStat(Request $request) {
        $stg = AStatments::GetGroupStatment($request->stgid);
		$data = "";
		foreach ($stg as $s) {
			$data .= "<tr onclick='InsertPrikaz(event)'><td>".$s->id."</td><td>".$s->famil.' '.$s->name.' '.$s->otch."</td></tr>";
		}
		return $data; 

    }
    public function GetStatgroupWithPrikaz(Request $request){
        $stg = AStatments::GetGroupStatmentWithPrikaz($request->stgid, $request->prik_id);
		$data = "";
		foreach ($stg as $s) {
			$data .= "<tr onclick='InsertPrikaz(event, true)'><td>".$s->id."</td><td>".$s->famil.' '.$s->name.' '.$s->otch."</td></tr>";
		}
		return $data; 
    }
    public function UpdateZach(Request $request){
        AStatments::UpdatePrikazStatment($request->stid, $request->prik_id);
    }
}