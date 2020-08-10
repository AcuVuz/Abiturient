<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\ABranch;
use App\AExamsCard;
use App\AFormObuch;
use App\AGroup;
use App\AFacultet;
use App\ASTLevel;
use App\APredmets;
use App\AVedomost;
use App\ATypExam;

class VedomostController extends Controller
{
    public function index()
    {
        $role = session('role_id');
		$users = session('user_name');
        $abit_branch = ABranch::GetBranch();
        $type_exam = ATypExam::GetTypExam();
        return view('VedomostPage.main', [
                'title'         => 'Ведомости',
				'role' 			=> $role,
				'username' 		=> $users,
                'abit_branch'   => $abit_branch,
                'type_exam'     => $type_exam
            ]
        );
    }
    public function get_facultet(Request $request)
	{
		$fk = AFacultet::GetFacultet($request->bid);
		$data = "<option>Выберите элемент</option>";
		foreach ($fk as $f) {
			$data .= "<option value='".$f->id."'>".$f->name."</option>";
		}
		return $data;
	}

	public function get_stlevel(Request $request)
	{
		$stlevel = ASTLevel::GetSTLevel($request->fkid);
		$data = "<option>Выберите элемент</option>";
		foreach ($stlevel as $st) {
			$data .= "<option value='".$st->id."'>".$st->name."</option>";
		}
		return $data;
	}

	public function get_form_obuch(Request $request)
	{
		$formobuch = AFormObuch::GetFormObuch($request->fkid, $request->stid);
		$data = "<option>Выберите элемент</option>";
		foreach ($formobuch as $fo) {
			$data .= "<option value='".$fo->id."'>".$fo->name."</option>";
		}
		return $data;
	}

	public function get_group(Request $request)
	{
		$group = AGroup::GetGroup($request->fkid, $request->stid, $request->foid);
                    
		$data = "<option>Выберите элемент</option>";
		foreach ($group as $g) {
			$data .= "<option value='".$g->id."'>".$g->name."</option>";
		}
		return $data;
	}

	public function get_predmet(Request $request)
	{
		$predmet = APredmets::GetGroupPredmet($request->gid);
		$data = "<option>Выберите элемент</option>";
		foreach ($predmet as $p) {
			$data .= "<option value='".$p->exid."'>".$p->name."</option>";
		}
		return $data;
	}

	public function get_vedomost(Request $request)
	{
        $predmet = APredmets::GetGroupPredmet($request->gid)->where('exid', $request->exid)->first();
		$vedomost = AVedomost::GetVedomost($request->exid, $request->stid, $request->foid, $predmet->id, $request->etid, $request->date_exam);
        
        if (count($vedomost) == 0) $data = "<tr><td class='text-center' colspan='5'>Нет записей</td></tr>";
        else $data = "";
        $i = 1;
		foreach ($vedomost as $v) {
            $count = AVedomost::CountPers($v->id, $request->etid);
            $data .= "<tr onclick='ved_id=".$v->id."'>";
            $data .= "<td>".$i."</td>";
            $data .= "<td>".$v->id."</td>";
            $data .= "<td>".$v->name."</td>";
            $data .= "<td>".$v->date_vedom."</td>";
            $data .= "<td>".$count."</td>";
			$data .= "</tr>";
			$i++;
		}
		return $data;
    }
    
    public function create(Request $request)
    {  
        $limit = 30;
		$actual = 0;
		
		$predmet = APredmets::GetGroupPredmet($request->abit_group)->where('exid', $request->abit_examenGroup)->first();
        $vedomost = AVedomost::GetVedomost($request->abit_examenGroup, $request->abit_stlevel, $request->abit_formobuch, 
                                        $predmet->id, $request->abit_typeExam, $request->date_exam);   
		
		foreach ($vedomost as $v) {
            $actual = AVedomost::CountPers($v->id, $request->abit_typeExam);
            if ($actual < $limit)
                AVedomost::FillVedomost($v->id, $limit, $actual, $request->abit_examenGroup, $request->date_exam, $request->abit_typeExam); 
        }

		$examCradCount = AExamsCard::GetAllExamCard($request->abit_examenGroup, $request->abit_typeExam)->count();
		$actual = 0;
		if ($examCradCount > 0) {
			for ($i = 0; $i <= ($examCradCount / $limit); $i++)
			{
				$vedomost = AVedomost::Create($request->abit_examenGroup, $request->abit_stlevel, $request->abit_formobuch, 
											$predmet->id, $request->abit_typeExam, $request->date_exam);
				AVedomost::FillVedomost($vedomost->id, $limit, $actual, $request->abit_examenGroup, $request->date_exam, $request->abit_typeExam); 							
			}
		}
        return back();
	}
	
	public function delete_vedomost(Request $request)
	{
		AVedomost::remove($request->ved_id);
		return back();
	}
}
