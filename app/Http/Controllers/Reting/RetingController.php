<?php

namespace App\Http\Controllers\Reting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AExamsCard;
use App\ABranch;
use App\AFacultet;
use App\AGroup;
use App\AFormObuch;

class RetingController extends Controller
{

    public function index()
    {
        $role = session('role_id');
        $users = session('user_name');


        return view('ReitingPage.reting_phone',
            [
                'title' => 'Рейтинг с телефонами',
                'role' => $role,
                'username' => $users
            ]);
    }
    public function reitmag(){

        $role = session('role_id');
        $users = session('user_name');
        $abit_branch = ABranch::GetBranch();

        return view('ReitingPage.reting_magistr',
            [
                'title' => 'Рейтинг магистратура',
                'role' => $role,
                'username' => $users,
                'abit_branch' => $abit_branch
            ]);
    }
    public function reitbak(){

        $role = session('role_id');
        $users = session('user_name');
        $abit_branch = ABranch::GetBranch();

        return view('ReitingPage.reiting_bakalavr',
            [
                'title' => 'Рейтинг бакалавриат',
                'role' => $role,
                'username' => $users,
                'abit_branch' => $abit_branch
            ]);
    }

    public function PrepareReport(Request $request){
       if($request->stid == 3){
            $query = DB::select('CALL abit_reit_mag(?)',[$request->gid]);
            $report = 'ReportPages.Report_Reit_Mag';
       }else if($request->stid == 1){
            $query = DB::select('CALL abit_reit_bak(?)',[$request->gid]);
            $report = 'ReportPages.Report_Reit_Bak';
       }
       
       $facultet = AFacultet::GetFacultetName($request->fkid);
       $group = AGroup::GetGroupName($request->gid);
       $formobuch = AFormObuch::GetFormObuchName($request->foid);
       
       return view($report,['query' => $query,
       'facultet' => $facultet,
       'group_name' => $group->name,
       'foname' => $formobuch->name]);
    }
}
