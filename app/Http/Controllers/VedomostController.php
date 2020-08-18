<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
use App\PersTest;

class VedomostController extends Controller
{
    public function index()
    {
        $role = session('role_id');
		$users = session('user_name');
        $abit_branch = ABranch::GetBranch();
		$type_exam = ATypExam::GetTypExam();
		$stlvl = ASTLevel::All();
        return view('VedomostPage.main', [
                'title'         => 'Ведомости',
				'role' 			=> $role,
				'username' 		=> $users,
                'abit_branch'   => $abit_branch,
                'type_exam'     => $type_exam,
                'stlvl'     	=> $stlvl
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
		$data = "<option>Выберите элемент</option>";
		$predmet = APredmets::GetGroupPredmet($request->gid);
		foreach ($predmet as $p) {
			$data .= "<option value='".$p->exid."'>".$p->name."</option>";
		}

		return $data;
	}

	public function get_predmet_no_spec(Request $request)
	{
		$data = "<option>Выберите элемент</option>";
		$predmet = APredmets::GetPredmetLNUWithStlevel($request->stlvl);
		foreach ($predmet as $p) {
			$data .= "<option value='".$p->id."'>".$p->name."</option>";
		}
		
		return $data;
	}

	public function get_vedomost(Request $request)
	{
		if (isset($request->gid)) {
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
		} else {
			$vedomost = AVedomost::GetVedomostFromPredmet($request->stid, $request->predid, $request->etid, $request->date_exam);
			
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
		}
		return $data;
    }
    
    public function create(Request $request)
    {  
        $limit = 30;
		$actual = 0;
		
		if (isset($request->abit_group)) {
			$predmet = APredmets::GetGroupPredmet($request->abit_group)->where('exid', $request->abit_examenGroup)->first();
			$vedomost = AVedomost::GetVedomost($request->abit_examenGroup, $request->abit_stlevel, $request->abit_formobuch, 
											$predmet->id, $request->abit_typeExam, $request->date_exam);   
			
			foreach ($vedomost as $v) {
				$actual = AVedomost::CountPers($v->id, $request->abit_typeExam);
				if ($actual < $limit)
					AVedomost::FillVedomost($v->id, $limit, $actual, $request->abit_examenGroup, $request->date_exam, $request->abit_typeExam, null); 
			}

			$examCradCount = AExamsCard::GetAllExamCard($request->abit_examenGroup, $request->abit_typeExam, null)->count();
			$actual = 0;
			if ($examCradCount > 0) {
				for ($i = 0; $i <= ($examCradCount / $limit); $i++)
				{
					$vedomost = AVedomost::Create($request->abit_examenGroup, $request->abit_stlevel, $request->abit_formobuch, 
												$predmet->id, $request->abit_typeExam, $request->date_exam);
					AVedomost::FillVedomost($vedomost->id, $limit, $actual, $request->abit_examenGroup, $request->date_exam, $request->abit_typeExam, null); 							
				}
			}
		} else {
			$vedomost = AVedomost::GetVedomostFromPredmet($request->abit_stlevel, $request->abit_predmet, $request->abit_typeExam, $request->date_exam);
			foreach ($vedomost as $v) {
				$actual = AVedomost::CountPers($v->id, $request->abit_typeExam);
				if ($actual < $limit)
					AVedomost::FillVedomost($v->id, $limit, $actual, null, $request->date_exam, $request->abit_typeExam, $request->abit_predmet); 
			}
			$examCradCount = AExamsCard::GetAllExamCard(null, $request->abit_typeExam, $request->abit_predmet)->count();
			$actual = 0;
			if ($examCradCount > 0) {
				for ($i = 0; $i <= ($examCradCount / $limit); $i++)
				{
					$vedomost = AVedomost::Create(null, $request->abit_stlevel, null, 
									$request->abit_predmet, $request->abit_typeExam, $request->date_exam);
					AVedomost::FillVedomost($vedomost->id, $limit, $actual, null, $request->date_exam, $request->abit_typeExam, $request->abit_predmet); 							
				}
			}
		}
        return back();
	}
	
	public function delete_vedomost(Request $request)
	{
		AVedomost::remove($request->ved_id);
		return back();
	}

	public function fill_vedomost()
	{
		$role = session('role_id');
		$users = session('user_name');
		$vedList = AVedomost::All();
        return view('VedomostPage.fillVedom', [
                'title'         => 'Заполнение ведомости',
				'role' 			=> $role,
				'username' 		=> $users,
				'vedList'		=> $vedList
            ]
        );
	}

	public function get_vedPers(Request $request)
	{
		$vedPed = AVedomost::GetPersFromVedom($request->vid);
		
        $vedInfo = AVedomost::GetInfo($request->vid);
		$data[0] = '';
		$data[1] = $vedInfo->id.' - '.$vedInfo->predmet_name;
		$i = 1;
		foreach ($vedPed as $vp)
		{
			$data[0] .= '<tr>
				<td style="width: 50px; text-align: center">'.$i.'</td>
				<td>'.$vp->famil.' '.$vp->name.' '.$vp->otch.'</td>
				<td style="display: flex;justify-content: center;align-items: center; ">
					<input type="text" name="ball['.$vp->id.']" id="ball['.$vp->id.']" class="form-control" style="width: 60px" value="'.$vp->ball.'">
				</td>
			</tr>';
			$i++;
		}
		return $data;
	}

	public function save_vedPers(Request $request)
	{
		$vedPed = AVedomost::GetPersFromVedom($request->ved);
		foreach ($vedPed as $vp)
		{
			$abit = AExamsCard::find($vp->id);
			$abit->ball = isset($request->ball[$vp->id]) ? $request->ball[$vp->id] : null;
			$abit->save();
			$pt = PersTest::where('pers_id', '=', $vp->pid)->where('test_id', '=', $vp->tid)->first();
			if (isset($pt)) {
				$pt->test_ball_correct = isset($request->ball[$vp->id]) ? $request->ball[$vp->id] : null;
				$pt->status = 2;
				$pt->save();
			}
		}
	}
}
