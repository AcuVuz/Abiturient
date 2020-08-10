<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PersTest;
use App\ASTLevel;
use App\APredmets;
use App\AGrafikExam;

class GrafikController extends Controller
{
	
	public function index(Request $request)
	{
		$role = session('role_id');
		$users = session('user_name');
		$stlevel = ASTLevel::All();
		return view('GrafikPage.grafik', 
			[
				'title'     => 'График экзаменов',
				'role'      => $role,
				'username'  => $users,
				'stlevel'	=> $stlevel
			]
		); 
    }
    
    public function get_predmet(Request $request)
	{
		$predmet = APredmets::GetStlevelPredmet($request->stid);
        $data = [];
        $data0 = "<option>Выберите элемент</option>";
		foreach ($predmet as $p) {
			$data0 .= "<option value='".$p->id."'>".$p->name."</option>";
        }
        $data[0] = $data0;
        
        $grafikPredmet = AGrafikExam::getGrafik($request->stid);
        $i = 1;
        $data1 = "";
		foreach ($grafikPredmet as $p) {
            $data1 .= "<tr>";
            $data1 .= "<td>".$i."</td>";
            $data1 .= "<td>".$p->name."</td>";
            $data1 .= "<td>".$p->date_exam."</td>";
            $data1 .= "<td>".$p->date_exam_end."</td>";
			$data1 .= "</tr>";
			$i++;
		}
        $data[1] = $data1;
		return $data;
    }
    
    public function save(Request $request)
    {
        if (!isset($request->date_exam))
        {
            $ge = AGrafikExam::where('predmet_id', $request->abit_predmet)->where('st_id', $request->abit_stlevel)->delete();
            $test_id = APredmets::find($request->abit_predmet)->test_id;
            PersTest::where('test_id', $test_id)->whereNull('end_time')->update([ 'start_time' =>  null]);
        }
        else
        {
            $ge = AGrafikExam::where('predmet_id', $request->abit_predmet)->where('st_id', $request->abit_stlevel)->first();
            if ($ge == null)
                $ge = new AGrafikExam();
            $ge->predmet_id = $request->abit_predmet;
            $ge->st_id = $request->abit_stlevel;
            $ge->date_exam = date('Y-m-d H:i', strtotime($request->date_exam));
            $ge->date_exam_end = isset($request->date_exam_end) ? date('Y-m-d H:i', strtotime($request->date_exam_end)) : null;
            $ge->save();
            $test_id = APredmets::find($request->abit_predmet)->test_id;
            PersTest::where('test_id', $test_id)->whereNull('start_time')->update([ 'start_time' =>  date('Y-m-d H:i', strtotime($request->date_exam))]);
        }
        return back();
    }
}
